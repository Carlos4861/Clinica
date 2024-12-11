<?php
require_once 'models/CitaModel.php';

class CitaController {
    private $model;

    public function __construct($db) {
        $this->model = new CitaModel($db);
    }

    // Mostrar todas las citas
    public function index() {
        $citas = $this->model->obtenerTodas();
        require 'views/citas/index.php';
    }

    // Crear una nueva cita
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'paciente_id' => $_POST['paciente_id'],
                'doctor_id' => $_POST['doctor_id'],
                'fecha' => $_POST['fecha'],
                'hora' => $_POST['hora'],
                'confirmado' => isset($_POST['confirmado']) ? 1 : 0
            ];
            if ($this->model->insertar($datos)) {
                header('Location: index.php?controller=cita&action=index');
            } else {
                echo "Error al crear la cita.";
            }
        } else {
            require 'views/citas/create.php';
        }
    }
}
