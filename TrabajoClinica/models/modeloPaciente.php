<?php
class PacienteModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;  
    }

     public function obtenerTodos() {
        $query = "SELECT * FROM pacientes WHERE activo = 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     public function obtenerPorId($id) {
        $query = "SELECT * FROM pacientes WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     public function insertar($datos) {
        $query = "INSERT INTO pacientes (nombre, apellido, email, telefono, direccion, fecha_nacimiento)
                  VALUES (:nombre, :apellido, :email, :telefono, :direccion, :fecha_nacimiento)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':apellido', $datos['apellido']);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->bindParam(':telefono', $datos['telefono']);
        $stmt->bindParam(':direccion', $datos['direccion']);
        $stmt->bindParam(':fecha_nacimiento', $datos['fecha_nacimiento']);
        return $stmt->execute();
    }

     public function actualizar($id, $datos) {
        $query = "UPDATE pacientes
                  SET nombre = :nombre, apellido = :apellido, email = :email,
                      telefono = :telefono, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':apellido', $datos['apellido']);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->bindParam(':telefono', $datos['telefono']);
        $stmt->bindParam(':direccion', $datos['direccion']);
        $stmt->bindParam(':fecha_nacimiento', $datos['fecha_nacimiento']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

     public function eliminar($id) {
        $query = "UPDATE pacientes SET activo = 0 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
