<?php
class CitaModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Obtener todas las citas
    public function obtenerTodas() {
        $query = "SELECT citas.*, pacientes.nombre AS paciente, doctores.nombre AS doctor, especialidades.nombre AS especialidad
                  FROM citas
                  JOIN pacientes ON citas.paciente_id = pacientes.id
                  JOIN doctores ON citas.doctor_id = doctores.id
                  JOIN especialidades ON doctores.especialidad_id = especialidades.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insertar una nueva cita
    public function insertar($datos) {
        $query = "INSERT INTO citas (paciente_id, doctor_id, fecha, hora, confirmado)
                  VALUES (:paciente_id, :doctor_id, :fecha, :hora, :confirmado)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':paciente_id', $datos['paciente_id']);
        $stmt->bindParam(':doctor_id', $datos['doctor_id']);
        $stmt->bindParam(':fecha', $datos['fecha']);
        $stmt->bindParam(':hora', $datos['hora']);
        $stmt->bindParam(':confirmado', $datos['confirmado'], PDO::PARAM_BOOL);
        return $stmt->execute();
    }
}
