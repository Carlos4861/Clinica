<?php
require_once 'models/EspecialidadModel.php';

class EspecialidadController {
    private $model;

    public function __construct($db) {
        $this->model = new EspecialidadModel($db);
    }

    // Mostrar todas las especialidades
    public function index() {
        $especialidades = $this->model->obtenerTodas();
        require 'views/especialidades/index.php';
    }

    // Mostrar una especialidad específica
    public function show($id) {
        $especialidad = $this->model->obtenerPorId($id);
        if ($especialidad) {
            require 'views/especialidades/show.php';
        } else {
            echo "Especialidad no encontrada.";
        }
    }

    // Crear una nueva especialidad
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre' => $_POST['nombre']
            ];
            if ($this->model->insertar($datos)) {
                header('Location: index.php?controller=especialidad&action=index');
            } else {
                echo "Error al crear la especialidad.";
            }
        } else {
            require 'views/especialidades/create.php';
        }
    }

    // Editar una especialidad existente
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre' => $_POST['nombre']
            ];
            if ($this->model->actualizar($id, $datos)) {
                header('Location: index.php?controller=especialidad&action=index');
            } else {
                echo "Error al actualizar la especialidad.";
            }
        } else {
            $especialidad = $this->model->obtenerPorId($id);
            require 'views/especialidades/edit.php';
        }
    }

    // Eliminar una especialidad
    public function delete($id) {
        if ($this->model->eliminar($id)) {
            header('Location: index.php?controller=especialidad&action=index');
        } else {
            echo "Error al eliminar la especialidad.";
        }
    }
}
