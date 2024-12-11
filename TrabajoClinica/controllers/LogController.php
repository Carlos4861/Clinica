<?php
require_once 'models/LogModel.php';

class LogController {
    private $model;

    public function __construct($db) {
        $this->model = new LogModel($db);
    }

    // Mostrar todos los registros del log
    public function index() {
        $logs = $this->model->obtenerTodos();
        require 'views/log/index.php';
    }
}
