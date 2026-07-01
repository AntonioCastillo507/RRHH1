<?php
class Signature {
    private static string $keyDir = __DIR__ . '/../keys';

    public static function ensureKeys(): void {
        if (!is_dir(self::$keyDir)) mkdir(self::$keyDir, 0700, true);
        $priv = self::$keyDir . '/private.pem';
        $pub  = self::$keyDir . '/public.pem';
        if (!file_exists($priv)) {
            $res = openssl_pkey_new(['private_key_bits' => 2048, 'private_key_type' => OPENSSL_KEYTYPE_RSA]);
            openssl_pkey_export($res, $privKey);
            file_put_contents($priv, $privKey);
            $details = openssl_pkey_get_details($res);
            file_put_contents($pub, $details['key']);
        }
    }

    public static function buildPayload(array $d): string {
        return implode('|', [
            $d['salario'], $d['codigo_empleado'], $d['tipo_empleado'],
            $d['planilla_id'], $d['ocupacion_id'], $d['fecha_inicio']
        ]);
    }

    public static function sign(array $d): string {
        self::ensureKeys();
        $privKey = openssl_pkey_get_private(file_get_contents(self::$keyDir . '/private.pem'));
        openssl_sign(self::buildPayload($d), $signature, $privKey, OPENSSL_ALGO_SHA256);
        return base64_encode($signature);
    }

    public static function verify(array $d, string $signatureB64): bool {
        self::ensureKeys();
        $pubKey = openssl_pkey_get_public(file_get_contents(self::$keyDir . '/public.pem'));
        $signature = base64_decode($signatureB64);
        return openssl_verify(self::buildPayload($d), $signature, $pubKey, OPENSSL_ALGO_SHA256) === 1;
    }
}
