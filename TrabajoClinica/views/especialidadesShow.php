<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de la Especialidad</title>
</head>
<body>
    <h1>Detalle de la Especialidad</h1>
    <p><strong>ID:</strong> <?= htmlspecialchars($especialidad['id']); ?></p>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($especialidad['nombre']); ?></p>
    <br>
    <a href="index.php?controller=especialidad&action=index">Volver al Listado</a>
</body>
</html>
