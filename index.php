<?php
session_start();

// Configuración de rutas
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$path = str_replace('/mvcwebi', '', $path); // Ajustar según tu directorio

// Autoload de clases
spl_autoload_register(function ($class) {
    $paths = [
        'controllers/' . $class . '.php',
        'models/' . $class . '.php',
        'config/' . $class . '.php'
    ];
    
    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Incluir configuración
require_once 'config/Database.php';

// Enrutador simple
switch ($path) {
    case '/':
    case '/login':
        $controller = new AuthController();
        $controller->login();
        break;
    
    case '/logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    
    case '/dashboard':
        $controller = new DashboardController();
        $controller->index();
        break;
    
    case '/usuarios':
        $controller = new UsuarioController();
        $controller->index();
        break;
    
    case '/usuarios/create':
        $controller = new UsuarioController();
        $controller->create();
        break;
    
    case '/usuarios/edit':
        $controller = new UsuarioController();
        $controller->edit();
        break;
    
    case '/usuarios/delete':
        $controller = new UsuarioController();
        $controller->delete();
        break;
    
    case '/usuarios/enable':
        $controller = new UsuarioController();
        $controller->enable();
        break;
    
    case '/productos':
        $controller = new ProductoController();
        $controller->index();
        break;
    
    case '/productos/create':
        $controller = new ProductoController();
        $controller->create();
        break;
    
    case '/productos/edit':
        $controller = new ProductoController();
        $controller->edit();
        break;
    
    case '/productos/delete':
        $controller = new ProductoController();
        $controller->delete();
        break;
    
    case '/productos/enable':
        $controller = new ProductoController();
        $controller->enable();
        break;
    
    case '/productos/view':
        $controller = new ProductoController();
        $controller->view();
        break;
    
    case '/reportes':
        $controller = new ReporteController();
        $controller->index();
        break;
    
    case '/reportes/graficos':
        $controller = new ReporteController();
        $controller->graficos();
        break;
    
    case '/graficos/barraProductos':
        $controller = new GraficoController();
        $controller->barraProductos();
        break;
    
    case '/graficos/pieEstadisticas':
        $controller = new GraficoController();
        $controller->pieEstadisticas();
        break;
    
    case '/graficos/lineaTendencia':
        $controller = new GraficoController();
        $controller->lineaTendencia();
        break;
    
    case '/reportes/pdfResumen':
        $controller = new ReporteController();
        $controller->pdfResumen();
        break;
        
    case '/reportes/pdfUsuarios':
        $controller = new ReporteController();
        $controller->pdfUsuarios();
        break;
        
    case '/reportes/pdfProductos':
        $controller = new ReporteController();
        $controller->pdfProductos();
        break;
        
    case '/reportes/pdfGraficos':
        $controller = new ReporteController();
        $controller->pdfGraficos();
        break;
    
    default:
        header("HTTP/1.0 404 Not Found");
        echo "Página no encontrada";
        break;
}
?>