<?php
class Sanitizer {
    public static function text(string $value): string {
        return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    }
    public static function toTitleCase(string $value): string {
        return mb_convert_case(mb_strtolower(trim($value), 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
    }
    public static function email(string $value): string {
        return filter_var(trim($value), FILTER_SANITIZE_EMAIL);
    }
    public static function digitsOnly(string $value): string {
        return preg_replace('/[^0-9\+\-]/', '', $value);
    }
    public static function decimal($value): float {
        return round((float) preg_replace('/[^0-9\.\-]/', '', (string)$value), 2);
    }
    public static function intVal($value): int {
        return (int) preg_replace('/[^0-9\-]/', '', (string)$value);
    }
    public static function cleanArray(array $data): array {
        $out = [];
        foreach ($data as $k => $v) {
            $out[$k] = is_string($v) ? self::text($v) : $v;
        }
        return $out;
    }
}
