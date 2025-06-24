<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $id;
    public $usuario;
    public $password;
    public $nombre;
    public $estado;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function login($usuario, $password) {
        $query = "SELECT id, usuario, nombre FROM " . $this->table_name . " 
                  WHERE usuario = :usuario AND password = :password AND estado = 'Habilitado' LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll() {
        $query = "SELECT id, usuario, nombre, estado FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT id, usuario, password, nombre, estado FROM " . $this->table_name . " 
                  WHERE id = :id LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->usuario = $row['usuario'];
            $this->password = $row['password'];
            $this->nombre = $row['nombre'];
            $this->estado = $row['estado'];
            return true;
        }
        return false;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET usuario=:usuario, password=:password, nombre=:nombre, estado=:estado";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':estado', $this->estado);

        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET usuario=:usuario, password=:password, nombre=:nombre, estado=:estado 
                  WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function delete() {
        // Cambiar a eliminación lógica
        $query = "UPDATE " . $this->table_name . " SET estado = 'Deshabilitado' WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function enable() {
        $query = "UPDATE " . $this->table_name . " SET estado = 'Habilitado' WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function count() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}
?>