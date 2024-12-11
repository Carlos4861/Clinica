<?php
require_once 'models/PacienteModel.php';

class PacienteController {
    private $model;

    public function __construct($db) {
        $this->model = new PacienteModel($db);
    }

     public function index() {
        $pacientes = $this->model->obtenerTodos();
        require 'views/pacientes/index.php'; // Vista para mostrar la lista de pacientes
    }

     public function show($id) {
        $paciente = $this->model->obtenerPorId($id);
        if ($paciente) {
            require 'views/pacientes/show.php'; // Vista para mostrar los detalles
        } else {
            echo "Paciente no encontrado.";
        }
    }

     public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'email' => $_POST['email'],
                'telefono' => $_POST['telefono'],
                'direccion' => $_POST['direccion'],
                'fecha_nacimiento' => $_POST['fecha_nacimiento']
            ];
            if ($this->model->insertar($datos)) {
                header('Location: index.php?controller=paciente&action=index');
            } else {
                echo "Error al crear el paciente.";
            }
        } else {
            require 'views/pacientes/create.php'; // Vista para el formulario de creación
        }
    }

     public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'email' => $_POST['email'],
                'telefono' => $_POST['telefono'],
                'direccion' => $_POST['direccion'],
                'fecha_nacimiento' => $_POST['fecha_nacimiento']
            ];
            if ($this->model->actualizar($id, $datos)) {
                header('Location: index.php?controller=paciente&action=index');
            } else {
                echo "Error al actualizar el paciente.";
            }
        } else {
            $paciente = $this->model->obtenerPorId($id);
            require 'views/pacientes/edit.php'; // Vista para el formulario de edición
        }
    }

     public function delete($id) {
        if ($this->model->eliminar($id)) {
            header('Location: index.php?controller=paciente&action=index');
        } else {
            echo "Error al eliminar el paciente.";
        }
    }
}
