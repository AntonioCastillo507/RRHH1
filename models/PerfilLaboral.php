<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../classes/Signature.php';

class PerfilLaboral {
    // Promoción: desactiva el cargo activo anterior y crea uno nuevo (no se sobreescribe historial)
    public static function crearOPromover(array $d): int {
        Database::query(
            "UPDATE perfil_laboral SET cargo_activo = 0 WHERE codigo_empleado = :cod AND cargo_activo = 1",
            ['cod' => $d['codigo_empleado']]
        );

        $firma = Signature::sign($d);

        Database::query(
            "INSERT INTO perfil_laboral
                (codigo_empleado, ocupacion_id, planilla_id, salario, tipo_empleado,
                 cargo_activo, empleado_activo, fecha_inicio, fecha_fin, es_activo, motivo_baja, firma)
             VALUES
                (:codigo_empleado,:ocupacion_id,:planilla_id,:salario,:tipo_empleado,
                 1, 1, :fecha_inicio, NULL, 1, NULL, :firma)",
            [
                'codigo_empleado' => $d['codigo_empleado'],
                'ocupacion_id'    => $d['ocupacion_id'],
                'planilla_id'     => $d['planilla_id'],
                'salario'         => $d['salario'],
                'tipo_empleado'   => $d['tipo_empleado'],
                'fecha_inicio'    => $d['fecha_inicio'],
                'firma'           => $firma,
            ]
        );
        return (int) Database::lastInsertId();
    }

    // Registrar baja: fecha_fin + motivo => empleado_activo = 0
    public static function registrarBaja(int $perfilId, string $fechaFin, string $motivo): void {
        Database::query(
            "UPDATE perfil_laboral SET fecha_fin = :ff, motivo_baja = :m, empleado_activo = 0, es_activo = 0
             WHERE id = :id",
            ['ff' => $fechaFin, 'm' => $motivo, 'id' => $perfilId]
        );
    }

    public static function historialDeEmpleado(int $codigoEmpleado): array {
        return Database::query(
            "SELECT * FROM perfil_laboral WHERE codigo_empleado = :cod ORDER BY fecha_inicio DESC",
            ['cod' => $codigoEmpleado]
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function reporteCompleto(): array {
        return Database::query(
            "SELECT c.id, c.identidad, c.nombre, c.apellido, c.correo, c.celular, c.ruta,
                    p.id AS perfil_id, p.salario, p.tipo_empleado, p.fecha_inicio, p.fecha_fin,
                    p.cargo_activo, p.empleado_activo, p.motivo_baja, p.firma,
                    p.ocupacion_id, p.planilla_id,
                    o.nombre AS ocupacion, t.nombre AS planilla
             FROM colaborador c
             JOIN perfil_laboral p ON p.codigo_empleado = c.id
             JOIN cat_ocupaciones o ON o.id = p.ocupacion_id
             JOIN cat_tipos_planilla t ON t.id = p.planilla_id
             ORDER BY c.id DESC, p.fecha_inicio DESC"
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function ocupaciones(): array {
        return Database::query("SELECT * FROM cat_ocupaciones")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function planillas(): array {
        return Database::query("SELECT * FROM cat_tipos_planilla")->fetchAll(PDO::FETCH_ASSOC);
    }
}
