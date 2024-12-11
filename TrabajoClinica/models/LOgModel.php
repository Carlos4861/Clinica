<?php
class LogModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Registrar una acción en el log
    public function registrar($datos) {
        $query = "INSERT INTO log (usuario_id, accion, fecha_hora) 
                  VALUES (:usuario_id, :accion, :fecha_hora)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':usuario_id', $datos['usuario_id']);
        $stmt->bindParam(':accion', $datos['accion']);
        $stmt->bindParam(':fecha_hora', $datos['fecha_hora']);
        return $stmt->execute();
    }

    // Obtener todos los registros del log
    public function obtenerTodos() {
        $query = "SELECT log.*, usuarios.nombre AS usuario 
                  FROM log
                  JOIN usuarios ON log.usuario_id = usuarios.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
