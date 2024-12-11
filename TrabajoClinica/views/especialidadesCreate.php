<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Especialidad</title>
</head>
<body>
    <h1>Crear Nueva Especialidad</h1>
    <form action="index.php?controller=especialidad&action=create" method="POST">
        <label for="nombre">Nombre de la Especialidad:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <button type="submit">Guardar</button>
    </form>
    <br>
    <a href="index.php?controller=especialidad&action=index">Volver al Listado</a>
</body>
</html>
