<?php
class DoctorModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Obtener todos los doctores activos
    public function obtenerTodos() {
        $query = "SELECT doctores.*, especialidades.nombre AS especialidad 
                  FROM doctores 
                  JOIN especialidades ON doctores.especialidad_id = especialidades.id
                  WHERE doctores.activo = 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un doctor por ID
    public function obtenerPorId($id) {
        $query = "SELECT * FROM doctores WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insertar un nuevo doctor
    public function insertar($datos) {
        $query = "INSERT INTO doctores (nombre, apellido, email, telefono, especialidad_id)
                  VALUES (:nombre, :apellido, :email, :telefono, :especialidad_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':apellido', $datos['apellido']);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->bindParam(':telefono', $datos['telefono']);
        $stmt->bindParam(':especialidad_id', $datos['especialidad_id']);
        return $stmt->execute();
    }

    // Actualizar un doctor
    public function actualizar($id, $datos) {
        $query = "UPDATE doctores
                  SET nombre = :nombre, apellido = :apellido, email = :email,
                      telefono = :telefono, especialidad_id = :especialidad_id
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':apellido', $datos['apellido']);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->bindParam(':telefono', $datos['telefono']);
        $stmt->bindParam(':especialidad_id', $datos['especialidad_id']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Eliminar (desactivar) un doctor
    public function eliminar($id) {
        $query = "UPDATE doctores SET activo = 0 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
