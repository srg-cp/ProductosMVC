<?php
class AuthController {
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if (!empty($usuario) && !empty($password)) {
                $usuarioModel = new Usuario();
                $result = $usuarioModel->login($usuario, $password);
                
                if ($result) {
                    $_SESSION['user_id'] = $result['id'];
                    $_SESSION['user_name'] = $result['nombre'];
                    $_SESSION['username'] = $result['usuario'];
                    header('Location: /mvcwebi/dashboard');
                    exit();
                } else {
                    $error = "Credenciales incorrectas";
                }
            } else {
                $error = "Todos los campos son obligatorios";
            }
        }
        
        // Si ya está logueado, redirigir al dashboard
        if (isset($_SESSION['user_id'])) {
            header('Location: /mvcwebi/dashboard');
            exit();
        }
        
        include 'views/auth/login.php';
    }
    
    public function logout() {
        session_destroy();
        header('Location: /mvcwebi/login');
        exit();
    }
    
    public function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /mvcwebi/login');
            exit();
        }
    }
}
?>