<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro de Colaborador</title>
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
        <h2>Registro de Colaborador</h2>
        <?php if (!empty($errors)): ?>
            <div class="alert-error"><?= implode('<br>', array_map('htmlspecialchars', $errors)) ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="alert-success">Colaborador guardado. Código de Empleado: <?= (int)$newId ?></div>
        <?php endif; ?>
        <form method="POST" action="index.php?action=colaborador_guardar">
            <label>Identidad (Documento de Identificación)</label>
            <input type="text" name="identidad" required>

            <label>Nombre</label>
            <input type="text" name="nombre" required>

            <label>Apellido</label>
            <input type="text" name="apellido" required>

            <label>Edad</label>
            <input type="number" name="edad" required>

            <label>Tipo de Sangre</label>
            <select name="tipo_sangre" required>
                <?php foreach (['O+','O-','A+','A-','B+','B-','AB+','AB-'] as $ts): ?>
                    <option value="<?= $ts ?>"><?= $ts ?></option>
                <?php endforeach; ?>
            </select>

            <label>Sexo</label>
            <select name="sexo" required>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>

            <label>Nacionalidad</label>
            <input type="text" name="nacionalidad" required>

            <label>Ruta del Colaborador</label>
            <select name="ruta" required>
                <option value="Este">Panamá Este</option>
                <option value="Oeste">Panamá Oeste</option>
                <option value="Norte">Panamá Norte</option>
            </select>

            <label>Correo</label>
            <input type="email" name="correo" required>

            <label>Celular</label>
            <input type="text" name="celular" required>

            <button class="btn" type="submit">Guardar Colaborador</button>
        </form>
    </div>
</div>
<?php include __DIR__ . '/partial_footer.php'; ?>
