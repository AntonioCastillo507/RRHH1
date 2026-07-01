<?php
require_once __DIR__ . '/../classes/Validator.php';
require_once __DIR__ . '/../classes/Sanitizer.php';
require_once __DIR__ . '/../models/PerfilLaboral.php';

class PerfilLaboralController {
    public static function guardar(array $post): array {
        $errors = Validator::validatePerfil($post);
        if (!empty($post['codigo_empleado']) === false) $errors[] = 'Empleado requerido.';
        if (!empty($errors)) return ['ok' => false, 'errors' => $errors];

        $data = Sanitizer::cleanArray($post);
        $data['salario']         = Sanitizer::decimal($data['salario']);
        $data['codigo_empleado'] = Sanitizer::intVal($data['codigo_empleado']);
        $data['ocupacion_id']    = Sanitizer::intVal($data['ocupacion_id']);
        $data['planilla_id']     = Sanitizer::intVal($data['planilla_id']);
        $data['tipo_empleado']   = $data['tipo_empleado'] ?? 'Colaborador';

        $id = PerfilLaboral::crearOPromover($data);
        return ['ok' => true, 'id' => $id];
    }

    public static function darDeBaja(array $post): array {
        if (empty($post['perfil_id']) || empty($post['fecha_fin']) || empty($post['motivo'])) {
            return ['ok' => false, 'errors' => ['Faltan datos para registrar la baja.']];
        }
        PerfilLaboral::registrarBaja(
            (int) $post['perfil_id'],
            Sanitizer::text($post['fecha_fin']),
            Sanitizer::text($post['motivo'])
        );
        return ['ok' => true];
    }
}
