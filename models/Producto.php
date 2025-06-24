<?php
class Producto {
    private $conn;
    private $table_name = "productos";

    public $id;
    public $nombre;
    public $precio;
    public $foto;
    public $estado;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function readAll() {
        $query = "SELECT id, nombre, precio, foto, estado FROM " . $this->table_name . " WHERE estado = 'Habilitado' ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readAllWithDisabled() {
        $query = "SELECT id, nombre, precio, foto, estado FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT id, nombre, precio, foto, estado FROM " . $this->table_name . " 
                  WHERE id = :id LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->nombre = $row['nombre'];
            $this->precio = $row['precio'];
            $this->foto = $row['foto'];
            $this->estado = $row['estado'];
            return true;
        }
        return false;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET nombre=:nombre, precio=:precio, foto=:foto, estado=:estado";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':foto', $this->foto);
        $stmt->bindParam(':estado', $this->estado);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return $this->id;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre=:nombre, precio=:precio, foto=:foto, estado=:estado 
                  WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':foto', $this->foto);
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

    public function getTotalValue() {
        $query = "SELECT SUM(precio) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    public function getAvgPrice() {
        $query = "SELECT AVG(precio) as promedio FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['promedio'] ?? 0;
    }

    public function uploadImage($file) {
        $target_dir = "uploads/productos/";
        
        // Crear directorio si no existe
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $target_file = $target_dir . $this->id . "." . $imageFileType;
        
        // Verificar si es una imagen real
        $check = getimagesize($file["tmp_name"]);
        if($check === false) {
            return false;
        }
        
        // Verificar tamaño del archivo (5MB máximo)
        if ($file["size"] > 5000000) {
            return false;
        }
        
        // Permitir ciertos formatos
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            return false;
        }
        
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        }
        
        return false;
    }

    public function getLastInsertId() {
        return $this->conn->lastInsertId();
    }
}
?>