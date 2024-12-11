<?php
class EspecialidadModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Obtener todas las especialidades
    public function obtenerTodas() {
        $query = "SELECT * FROM especialidades";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una especialidad por ID
    public function obtenerPorId($id) {
        $query = "SELECT * FROM especialidades WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insertar una nueva especialidad
    public function insertar($datos) {
        $query = "INSERT INTO especialidades (nombre) VALUES (:nombre)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $datos['nombre']);
        return $stmt->execute();
    }

    // Actualizar una especialidad
    public function actualizar($id, $datos) {
        $query = "UPDATE especialidades SET nombre = :nombre WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Eliminar una especialidad
    public function eliminar($id) {
        $query = "DELETE FROM especialidades WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
