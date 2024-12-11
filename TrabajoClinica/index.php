<?php
session_start();

// Definir el controlador y la acción por defecto con validaciones adicionales
$controller = isset($_GET['controller']) ? preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['controller']) : 'usuario';  // Cambiar 'user' a 'usuario' si usas ese nombre
$action = isset($_GET['action']) ? preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['action']) : 'index';  // Cambiar 'login' a 'index'

// Determinar el archivo del controlador
$controllerFile = "controllers/" . ucfirst($controller) . "UsuarioController.php";

// Verificar si el controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Crear una instancia del controlador
    $controllerClass = ucfirst($controller) . "Controller";

    // Verificar si la clase existe en el archivo del controlador
    if (class_exists($controllerClass)) {
        $controllerInstance = new $controllerClass();

        // Verificar si la acción existe en el controlador
        if (method_exists($controllerInstance, $action)) {
            // Ejecutar la acción
            $controllerInstance->$action();
        } else {
            // Acción no encontrada
            die("Acción '$action' no encontrada en el controlador '$controller'.");
        }
    } else {
        // Clase del controlador no encontrada
        die("Clase '$controllerClass' no encontrada en el archivo '$controllerFile'.");
    }
} else {
    // Controlador no encontrado
    die("Controlador '$controller' no encontrado.");
}
?>
