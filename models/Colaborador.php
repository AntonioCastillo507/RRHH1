<?php
require_once __DIR__ . '/../config/database.php';

class Colaborador {
    public static function crear(array $d): int {
        Database::query(
            "INSERT INTO colaborador (identidad,nombre,apellido,edad,tipo_sangre,sexo,nacionalidad,ruta,correo,celular)
             VALUES (:identidad,:nombre,:apellido,:edad,:tipo_sangre,:sexo,:nacionalidad,:ruta,:correo,:celular)",
            $d
        );
        return (int) Database::lastInsertId();
    }

    public static function todos(): array {
        return Database::query("SELECT * FROM colaborador ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function porId(int $id): ?array {
        $row = Database::query("SELECT * FROM colaborador WHERE id = :id", ['id' => $id])->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }
}
