<?php
class DashboardController {
    
    public function index() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        // Obtener estadísticas
        $usuarioModel = new Usuario();
        $productoModel = new Producto();
        
        $totalUsuarios = $usuarioModel->count();
        $totalProductos = $productoModel->count();
        $valorTotal = $productoModel->getTotalValue();
        $precioPromedio = $productoModel->getAvgPrice();
        
        $stats = [
            'usuarios' => $totalUsuarios,
            'productos' => $totalProductos,
            'valor_total' => $valorTotal,
            'precio_promedio' => $precioPromedio
        ];
        
        include 'views/dashboard/index.php';
    }
}
?>