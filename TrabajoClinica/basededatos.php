<?php
class Database {
    private static $host = 'localhost';
    private static $db_name = 'clinic';
    private static $username = 'root';
    private static $password = '';
    public static $conn;

    public static function connect() {
        if (!self::$conn) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error al conectar a la base de datos: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
?>
