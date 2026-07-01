<?php
require_once __DIR__ . '/models/PerfilLaboral.php';

$rows = PerfilLaboral::reporteCompleto();

header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename="reporte_colaboradores.xls"');

echo "\xEF\xBB\xBF"; // BOM for UTF-8
echo "Codigo\tNombre\tCorreo\tCelular\tOcupacion\tPlanilla\tSalario\tInicio\tFin\tCargoActivo\tEmpleadoActivo\n";
foreach ($rows as $r) {
    echo implode("\t", [
        $r['id'],
        $r['nombre'] . ' ' . $r['apellido'],
        $r['correo'],
        $r['celular'],
        $r['ocupacion'],
        $r['planilla'],
        number_format($r['salario'], 2, '.', ''),
        $r['fecha_inicio'],
        $r['fecha_fin'] ?? '',
        $r['cargo_activo'] ? 'Si' : 'No',
        $r['empleado_activo'] ? 'Si' : 'No',
    ]) . "\n";
}
