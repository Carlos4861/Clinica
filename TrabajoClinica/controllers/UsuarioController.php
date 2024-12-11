<?php
require_once 'models/ModeloUsuario.php';

class UsuarioController {
    private $model;

    public function __construct($db) {
        $this->model = new UsuarioModel($db);
    }

    // Listar todos los usuarios
    public function index() {
        $usuarios = $this->model->obtenerTodos();
        require 'views/usuarios/index.php';
    }

    // Mostrar un usuario específico
    public function show($id) {
        $usuario = $this->model->obtenerPorId($id);
        if ($usuario) {
            require 'views/usuarios/show.php';
        } else {
            echo "Usuario no encontrado.";
        }
    }

    // Crear un nuevo usuario
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre' => $_POST['nombre'],
                'email' => $_POST['email'],
                'contraseña' => $_POST['contraseña'],
                'rol' => $_POST['rol']
            ];
            if ($this->model->insertar($datos)) {
                header('Location: index.php?controller=usuario&action=index');
            } else {
                echo "Error al crear el usuario.";
            }
        } else {
            require 'views/usuarios/create.php';
        }
    }

    // Editar un usuario
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre' => $_POST['nombre'],
                'email' => $_POST['email'],
                'rol' => $_POST['rol']
            ];
            if ($this->model->actualizar($id, $datos)) {
                header('Location: index.php?controller=usuario&action=index');
            } else {
                echo "Error al actualizar el usuario.";
            }
        } else {
            $usuario = $this->model->obtenerPorId($id);
            require 'views/usuarios/edit.php';
        }
    }

    // Eliminar un usuario
    public function delete($id) {
        if ($this->model->eliminar($id)) {
            header('Location: index.php?controller=usuario&action=index');
        } else {
            echo "Error al eliminar el usuario.";
        }
    }
}
