<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Especialidades</title>
</head>
<body>
    <h1>Listado de Especialidades</h1>
    <a href="index.php?controller=especialidad&action=create">Crear Nueva Especialidad</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($especialidades as $especialidad): ?>
                <tr>
                    <td><?= htmlspecialchars($especialidad['id']); ?></td>
                    <td><?= htmlspecialchars($especialidad['nombre']); ?></td>
                    <td>
                        <a href="index.php?controller=especialidad&action=show&id=<?= $especialidad['id']; ?>">Ver</a>
                        <a href="index.php?controller=especialidad&action=edit&id=<?= $especialidad['id']; ?>">Editar</a>
                        <a href="index.php?controller=especialidad&action=delete&id=<?= $especialidad['id']; ?>" 
                           onclick="return confirm('¿Estás seguro de eliminar esta especialidad?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
