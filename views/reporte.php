<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte</title>
<link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="navbar">
    <div class="brand">⬡ iTECH Contrataciones</div>
    <div>
        <a href="index.php?action=colaborador_form">Nuevo Colaborador</a>
        <a href="index.php?action=perfil_form">Perfil Laboral</a>
        <a href="index.php?action=reporte">Reporte</a>
        <a href="export_excel.php">Exportar a Excel</a>
    </div>
</div>
<div class="container">
    <div class="card">
        <h2>Reporte de Colaboradores y Perfiles Laborales</h2>
        <table>
            <tr>
                <th>Código</th><th>Colaborador</th><th>Ocupación</th><th>Planilla</th>
                <th>Salario</th><th>Inicio</th><th>Fin</th><th>Cargo Activo</th>
                <th>Empleado Activo</th><th>Integridad</th>
            </tr>
            <?php foreach ($rows as $r):
                $checkData = [
                    'salario' => $r['salario'], 'codigo_empleado' => $r['id'],
                    'tipo_empleado' => $r['tipo_empleado'], 'planilla_id' => $r['planilla_id'],
                    'ocupacion_id' => $r['ocupacion_id'], 'fecha_inicio' => $r['fecha_inicio'],
                ];
                $valido = !empty($r['firma']) && Signature::verify($checkData, $r['firma']);
            ?>
            <tr>
                <td><?= $r['id'] ?></td>
                <td><?= htmlspecialchars($r['nombre'] . ' ' . $r['apellido']) ?>, <?= htmlspecialchars($r['correo']) ?>, <?= htmlspecialchars($r['celular']) ?></td>
                <td><?= htmlspecialchars($r['ocupacion']) ?></td>
                <td><?= htmlspecialchars($r['planilla']) ?></td>
                <td>$<?= number_format($r['salario'], 2) ?></td>
                <td><?= $r['fecha_inicio'] ?></td>
                <td><?= $r['fecha_fin'] ?? '-' ?></td>
                <td><?= $r['cargo_activo'] ? 'Sí' : 'No' ?></td>
                <td><?= $r['empleado_activo'] ? 'Sí' : 'No' ?></td>
                <td>
                    <?php if ($valido): ?>
                        <span class="badge badge-green">Íntegro</span>
                    <?php else: ?>
                        <span class="badge badge-red">Sin Firma</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php include __DIR__ . '/partial_footer.php'; ?>
