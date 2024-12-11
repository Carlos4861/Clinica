<?php
require_once 'models/DoctorModel.php';

class DoctorController {
    private $model;

    public function __construct($db) {
        $this->model = new DoctorModel($db);
    }

    // Mostrar todos los doctores
    public function index() {
        $doctores = $this->model->obtenerTodos();
        require 'views/doctores/index.php';
    }

    // Mostrar detalles de un doctor
    public function show($id) {
        $doctor = $this->model->obtenerPorId($id);
        if ($doctor) {
            require 'views/doctores/show.php';
        } else {
            echo "Doctor no encontrado.";
        }
    }

    // Crear un nuevo doctor
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'email' => $_POST['email'],
                'telefono' => $_POST['telefono'],
                'especialidad_id' => $_POST['especialidad_id']
            ];
            if ($this->model->insertar($datos)) {
                header('Location: index.php?controller=doctor&action=index');
            } else {
                echo "Error al crear el doctor.";
            }
        } else {
            require 'views/doctores/create.php';
        }
    }

    // Editar un doctor existente
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'email' => $_POST['email'],
                'telefono' => $_POST['telefono'],
                'especialidad_id' => $_POST['especialidad_id']
            ];
            if ($this->model->actualizar($id, $datos)) {
                header('Location: index.php?controller=doctor&action=index');
            } else {
                echo "Error al actualizar el doctor.";
            }
        } else {
            $doctor = $this->model->obtenerPorId($id);
            require 'views/doctores/edit.php';
        }
    }

    // Eliminar un doctor
    public function delete($id) {
        if ($this->model->eliminar($id)) {
            header('Location: index.php?controller=doctor&action=index');
        } else {
            echo "Error al eliminar el doctor.";
        }
    }
}
