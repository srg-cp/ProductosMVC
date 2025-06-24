<?php
class ReporteController {
    
    public function index() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        // Obtener datos para reportes
        $usuarioModel = new Usuario();
        $productoModel = new Producto();
        
        $totalUsuarios = $usuarioModel->count();
        $totalProductos = $productoModel->count();
        $valorTotal = $productoModel->getTotalValue();
        $precioPromedio = $productoModel->getAvgPrice();
        
        // Obtener todos los usuarios y productos para los reportes detallados
        $usuarios = $usuarioModel->readAll()->fetchAll(PDO::FETCH_ASSOC);
        $productos = $productoModel->readAll()->fetchAll(PDO::FETCH_ASSOC);
        
        $reportData = [
            'resumen' => [
                'usuarios' => $totalUsuarios,
                'productos' => $totalProductos,
                'valor_total' => $valorTotal,
                'precio_promedio' => $precioPromedio
            ],
            'usuarios' => $usuarios,
            'productos' => $productos
        ];
        
        include 'views/reportes/index.php';
    }
}
?>