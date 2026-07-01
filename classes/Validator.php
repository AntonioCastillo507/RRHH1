<?php
class Validator {
    public static function required($value): bool {
        return $value !== null && trim((string)$value) !== '';
    }
    public static function isEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    public static function isInt($value): bool {
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }
    public static function isDecimalPositive($value): bool {
        return is_numeric($value) && (float)$value > 0;
    }
    public static function isPhone(string $value): bool {
        return (bool) preg_match('/^[0-9\-\+\s]{7,15}$/', $value);
    }
    public static function isIdentity(string $value): bool {
        return (bool) preg_match('/^[0-9A-Za-z\-]{5,20}$/', $value);
    }
    public static function inList($value, array $list): bool {
        return in_array($value, $list, true);
    }
    public static function validateColaborador(array $d): array {
        $errors = [];
        if (!self::required($d['identidad'] ?? null) || !self::isIdentity($d['identidad'])) $errors[] = 'Identidad inválida.';
        if (!self::required($d['nombre'] ?? null)) $errors[] = 'Nombre requerido.';
        if (!self::required($d['apellido'] ?? null)) $errors[] = 'Apellido requerido.';
        if (!self::isInt($d['edad'] ?? null)) $errors[] = 'Edad inválida.';
        if (!self::required($d['tipo_sangre'] ?? null)) $errors[] = 'Tipo de sangre requerido.';
        if (!self::inList($d['sexo'] ?? '', ['M','F'])) $errors[] = 'Sexo inválido.';
        if (!self::required($d['nacionalidad'] ?? null)) $errors[] = 'Nacionalidad requerida.';
        if (!self::inList($d['ruta'] ?? '', ['Este','Oeste','Norte'])) $errors[] = 'Ruta inválida.';
        if (!self::isEmail($d['correo'] ?? '')) $errors[] = 'Correo inválido.';
        if (!self::isPhone($d['celular'] ?? '')) $errors[] = 'Celular inválido.';
        return $errors;
    }
    public static function validatePerfil(array $d): array {
        $errors = [];
        if (!self::required($d['ocupacion_id'] ?? null)) $errors[] = 'Ocupación requerida.';
        if (!self::required($d['planilla_id'] ?? null)) $errors[] = 'Planilla requerida.';
        if (!self::isDecimalPositive($d['salario'] ?? null)) $errors[] = 'Salario inválido.';
        if (!self::required($d['fecha_inicio'] ?? null)) $errors[] = 'Fecha de inicio requerida.';
        return $errors;
    }
}
