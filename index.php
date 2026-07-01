<?php
require_once __DIR__ . '/controllers/ColaboradorController.php';
require_once __DIR__ . '/controllers/PerfilLaboralController.php';
require_once __DIR__ . '/models/Colaborador.php';
require_once __DIR__ . '/models/PerfilLaboral.php';
require_once __DIR__ . '/classes/Signature.php';

$action = $_GET['action'] ?? 'colaborador_form';

switch ($action) {
    case 'colaborador_guardar':
        $result = ColaboradorController::guardar($_POST);
        $errors = $result['errors'] ?? [];
        $success = $result['ok'] ?? false;
        $newId = $result['id'] ?? null;
        include __DIR__ . '/views/colaborador_form.php';
        break;

    case 'perfil_guardar':
        $result = PerfilLaboralController::guardar($_POST);
        $errors = $result['errors'] ?? [];
        $success = $result['ok'] ?? false;
        $colaboradores = Colaborador::todos();
        $ocupaciones = PerfilLaboral::ocupaciones();
        $planillas = PerfilLaboral::planillas();
        include __DIR__ . '/views/perfil_form.php';
        break;

    case 'perfil_baja':
        $result = PerfilLaboralController::darDeBaja($_POST);
        $errors = $result['errors'] ?? [];
        $success = $result['ok'] ?? false;
        $colaboradores = Colaborador::todos();
        $ocupaciones = PerfilLaboral::ocupaciones();
        $planillas = PerfilLaboral::planillas();
        include __DIR__ . '/views/perfil_form.php';
        break;

    case 'perfil_form':
        $errors = [];
        $success = false;
        $colaboradores = Colaborador::todos();
        $ocupaciones = PerfilLaboral::ocupaciones();
        $planillas = PerfilLaboral::planillas();
        include __DIR__ . '/views/perfil_form.php';
        break;

    case 'reporte':
        $rows = PerfilLaboral::reporteCompleto();
        include __DIR__ . '/views/reporte.php';
        break;

    case 'colaborador_form':
    default:
        $errors = [];
        $success = false;
        $newId = null;
        include __DIR__ . '/views/colaborador_form.php';
        break;
}
