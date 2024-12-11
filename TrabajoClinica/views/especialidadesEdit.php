<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Especialidad</title>
</head>
<body>
    <h1>Editar Especialidad</h1>
    <form action="index.php?controller=especialidad&action=edit&id=<?= htmlspecialchars($especialidad['id']); ?>" method="POST">
        <label for="nombre">Nombre de la Especialidad:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($especialidad['nombre']); ?>" required>
        <br>
        <button type="submit">Actualizar</button>
    </form>
    <br>
    <a href="index.php?controller=especialidad&action=index">Volver al Listado</a>
</body>
</html>
