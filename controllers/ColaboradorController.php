<?php
require_once __DIR__ . '/../classes/Validator.php';
require_once __DIR__ . '/../classes/Sanitizer.php';
require_once __DIR__ . '/../models/Colaborador.php';

class ColaboradorController {
    public static function guardar(array $post): array {
        $errors = Validator::validateColaborador($post);
        if (!empty($errors)) return ['ok' => false, 'errors' => $errors];

        $data = Sanitizer::cleanArray($post);
        $data['nombre']   = Sanitizer::toTitleCase($data['nombre']);
        $data['apellido'] = Sanitizer::toTitleCase($data['apellido']);
        $data['correo']   = Sanitizer::email($data['correo']);
        $data['celular']  = Sanitizer::digitsOnly($data['celular']);
        $data['edad']     = Sanitizer::intVal($data['edad']);

        $id = Colaborador::crear([
            'identidad'    => $data['identidad'],
            'nombre'       => $data['nombre'],
            'apellido'     => $data['apellido'],
            'edad'         => $data['edad'],
            'tipo_sangre'  => $data['tipo_sangre'],
            'sexo'         => $data['sexo'],
            'nacionalidad' => $data['nacionalidad'],
            'ruta'         => $data['ruta'],
            'correo'       => $data['correo'],
            'celular'      => $data['celular'],
        ]);

        return ['ok' => true, 'id' => $id];
    }
}
