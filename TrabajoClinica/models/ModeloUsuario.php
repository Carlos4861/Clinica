<?php
class UsuarioModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Obtener todos los usuarios
    public function obtenerTodos() {
        $query = "SELECT * FROM usuarios";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un usuario por ID
    public function obtenerPorId($id) {
        $query = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insertar un nuevo usuario
    public function insertar($datos) {
        $query = "INSERT INTO usuarios (nombre, email, contraseña, rol) 
                  VALUES (:nombre, :email, :contraseña, :rol)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->bindParam(':contraseña', password_hash($datos['contraseña'], PASSWORD_BCRYPT));
        $stmt->bindParam(':rol', $datos['rol']);
        return $stmt->execute();
    }

    // Actualizar un usuario
    public function actualizar($id, $datos) {
        $query = "UPDATE usuarios 
                  SET nombre = :nombre, email = :email, rol = :rol 
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->bindParam(':rol', $datos['rol']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Cambiar la contraseña de un usuario
    public function cambiarContraseña($id, $nuevaContraseña) {
        $query = "UPDATE usuarios SET contraseña = :contraseña WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':contraseña', password_hash($nuevaContraseña, PASSWORD_BCRYPT));
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Eliminar un usuario
    public function eliminar($id) {
        $query = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
