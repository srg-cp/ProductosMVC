<?php
class ProductoController {
    
    public function index() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $producto = new Producto();
        $stmt = $producto->readAllWithDisabled();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        include 'views/productos/index.php';
    }
    
    public function create() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto = new Producto();
            $producto->nombre = $_POST['nombre'] ?? '';
            $producto->precio = $_POST['precio'] ?? 0;
            $producto->estado = $_POST['estado'] ?? 'Habilitado';
            
            if (!empty($producto->nombre) && $producto->precio > 0) {
                $newId = $producto->create();
                if ($newId) {
                    // Manejar subida de imagen
                    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                        $uploadResult = $producto->uploadImage($_FILES['foto']);
                        if ($uploadResult) {
                            $producto->foto = $uploadResult;
                            $producto->update();
                        }
                    }
                    
                    $_SESSION['success'] = "Producto creado exitosamente";
                    header('Location: /mvcwebi/productos');
                    exit();
                } else {
                    $error = "Error al crear el producto";
                }
            } else {
                $error = "Todos los campos son obligatorios y el precio debe ser mayor a 0";
            }
        }
        
        include 'views/productos/create.php';
    }
    
    public function edit() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $id = $_GET['id'] ?? 0;
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto = new Producto();
            $producto->id = $id;
            $producto->nombre = $_POST['nombre'] ?? '';
            $producto->precio = $_POST['precio'] ?? 0;
            $producto->estado = $_POST['estado'] ?? 'Habilitado';
            
            // Obtener datos actuales para mantener la foto si no se sube una nueva
            $productoActual = new Producto();
            $productoActual->id = $id;
            $productoActual->readOne();
            $producto->foto = $productoActual->foto;
            
            // Manejar subida de nueva imagen
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $uploadResult = $producto->uploadImage($_FILES['foto']);
                if ($uploadResult) {
                    $producto->foto = $uploadResult;
                }
            }
            
            if (!empty($producto->nombre) && $producto->precio > 0) {
                if ($producto->update()) {
                    $_SESSION['success'] = "Producto actualizado exitosamente";
                    header('Location: /mvcwebi/productos');
                    exit();
                } else {
                    $error = "Error al actualizar el producto";
                }
            } else {
                $error = "Todos los campos son obligatorios y el precio debe ser mayor a 0";
            }
        }
        
        $producto = new Producto();
        $producto->id = $id;
        if (!$producto->readOne()) {
            header('Location: /mvcwebi/productos');
            exit();
        }
        
        include 'views/productos/edit.php';
    }

    public function enable() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $id = $_GET['id'] ?? 0;
        
        if ($id > 0) {
            $producto = new Producto();
            $producto->id = $id;
            
            if ($producto->enable()) {
                $_SESSION['success'] = "Producto habilitado exitosamente";
            } else {
                $_SESSION['error'] = "Error al habilitar el producto";
            }
        }
        
        header('Location: /mvcwebi/productos');
        exit();
    }
    
    public function view() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $id = $_GET['id'] ?? 0;
        
        $producto = new Producto();
        $producto->id = $id;
        if (!$producto->readOne()) {
            header('Location: /mvcwebi/productos');
            exit();
        }
        
        include 'views/productos/view.php';
    }
    
    public function delete() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $id = $_GET['id'] ?? 0;
        
        if ($id > 0) {
            $producto = new Producto();
            $producto->id = $id;
            
            if ($producto->delete()) {
                $_SESSION['success'] = "Producto eliminado exitosamente";
            } else {
                $_SESSION['error'] = "Error al eliminar el producto";
            }
        }
        
        header('Location: /mvcwebi/productos');
        exit();
    }
}
?>