<?php
class UsuarioController {
    
    public function index() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $usuario = new Usuario();
        $stmt = $usuario->readAll();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        include 'views/usuarios/index.php';
    }
    
    public function create() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = new Usuario();
            $usuario->usuario = $_POST['usuario'] ?? '';
            $usuario->password = $_POST['password'] ?? '';
            $usuario->nombre = $_POST['nombre'] ?? '';
            
            if (!empty($usuario->usuario) && !empty($usuario->password) && !empty($usuario->nombre)) {
                if ($usuario->create()) {
                    $_SESSION['success'] = "Usuario creado exitosamente";
                    header('Location: /mvcwebi/usuarios');
                    exit();
                } else {
                    $error = "Error al crear el usuario";
                }
            } else {
                $error = "Todos los campos son obligatorios";
            }
        }
        
        include 'views/usuarios/create.php';
    }
    
    public function edit() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $id = $_GET['id'] ?? 0;
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = new Usuario();
            $usuario->id = $id;
            $usuario->usuario = $_POST['usuario'] ?? '';
            $usuario->password = $_POST['password'] ?? '';
            $usuario->nombre = $_POST['nombre'] ?? '';
            $usuario->estado = $_POST['estado'] ?? 'Habilitado';
            
            if (!empty($usuario->usuario) && !empty($usuario->password) && !empty($usuario->nombre)) {
                if ($usuario->update()) {
                    $_SESSION['success'] = "Usuario actualizado exitosamente";
                    header('Location: /mvcwebi/usuarios');
                    exit();
                } else {
                    $error = "Error al actualizar el usuario";
                }
            } else {
                $error = "Todos los campos son obligatorios";
            }
        }
        
        $usuario = new Usuario();
        $usuario->id = $id;
        if (!$usuario->readOne()) {
            header('Location: /mvcwebi/usuarios');
            exit();
        }
        
        include 'views/usuarios/edit.php';
    }

    public function enable() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $id = $_GET['id'] ?? 0;
        
        if ($id > 0) {
            $usuario = new Usuario();
            $usuario->id = $id;
            
            if ($usuario->enable()) {
                $_SESSION['success'] = "Usuario habilitado exitosamente";
            } else {
                $_SESSION['error'] = "Error al habilitar el usuario";
            }
        }
        
        header('Location: /mvcwebi/usuarios');
        exit();
    }
    
    public function delete() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $id = $_GET['id'] ?? 0;
        
        if ($id > 0) {
            $usuario = new Usuario();
            $usuario->id = $id;
            
            if ($usuario->delete()) {
                $_SESSION['success'] = "Usuario eliminado exitosamente";
            } else {
                $_SESSION['error'] = "Error al eliminar el usuario";
            }
        }
        
        header('Location: /mvcwebi/usuarios');
        exit();
    }
}
?>