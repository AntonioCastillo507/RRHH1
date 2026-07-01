<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Perfil Laboral</title>
<link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="navbar">
    <div class="brand">⬡ iTECH Contrataciones</div>
    <div>
        <a href="index.php?action=colaborador_form">Nuevo Colaborador</a>
        <a href="index.php?action=perfil_form">Perfil Laboral</a>
        <a href="index.php?action=reporte">Reporte</a>
    </div>
</div>
<div class="container">
    <div class="card">
        <h2>Perfil Laboral / Promoción</h2>
        <?php if (!empty($errors)): ?>
            <div class="alert-error"><?= implode('<br>', array_map('htmlspecialchars', $errors)) ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="alert-success">Perfil laboral registrado correctamente (firmado con OpenSSL).</div>
        <?php endif; ?>
        <form method="POST" action="index.php?action=perfil_guardar">
            <label>Código de Empleado</label>
            <select name="codigo_empleado" required>
                <?php foreach ($colaboradores as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['id'] . ' - ' . htmlspecialchars($c['nombre'] . ' ' . $c['apellido']) ?></option>
                <?php endforeach; ?>
            </select>

            <label>Puesto (Ocupación)</label>
            <select name="ocupacion_id" required>
                <?php foreach ($ocupaciones as $o): ?>
                    <option value="<?= $o['id'] ?>"><?= htmlspecialchars($o['nombre']) ?></option>
                <?php endforeach; ?>
            </select>

            <label>Planilla</label>
            <select name="planilla_id" required>
                <?php foreach ($planillas as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
                <?php endforeach; ?>
            </select>

            <label>Tipo de Empleado</label>
            <input type="text" name="tipo_empleado" placeholder="Ej. Administrativo" required>

            <label>Salario</label>
            <input type="number" step="0.01" name="salario" required>

            <label>Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" required>

            <button class="btn" type="submit">Guardar / Promover</button>
        </form>
    </div>

    <div class="card">
        <h2>Registrar Baja</h2>
        <form method="POST" action="index.php?action=perfil_baja">
            <label>ID de Perfil Laboral</label>
            <input type="number" name="perfil_id" required>

            <label>Fecha de Fin</label>
            <input type="date" name="fecha_fin" required>

            <label>Motivo de Baja</label>
            <input type="text" name="motivo" required>

            <button class="btn btn-secondary" type="submit">Registrar Baja</button>
        </form>
    </div>
</div>
<?php include __DIR__ . '/partial_footer.php'; ?>
