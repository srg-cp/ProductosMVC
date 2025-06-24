<?php
require_once 'config/Database.php';
require_once 'models/Usuario.php';
require_once 'models/Producto.php';
require_once 'controllers/AuthController.php';
require_once 'libs/fpdf/fpdf.php';

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
    
    public function graficos() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        // Obtener datos para reportes
        $usuarioModel = new Usuario();
        $productoModel = new Producto();
        
        $totalUsuarios = $usuarioModel->count();
        $totalProductos = $productoModel->count();
        $valorTotal = $productoModel->getTotalValue();
        $precioPromedio = $productoModel->getAvgPrice();
        
        $reportData = [
            'resumen' => [
                'usuarios' => $totalUsuarios,
                'productos' => $totalProductos,
                'valor_total' => $valorTotal,
                'precio_promedio' => $precioPromedio
            ]
        ];
        
        include 'views/reportes/graficos.php';
    }
    
    public function pdfResumen() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $usuarioModel = new Usuario();
        $productoModel = new Producto();
        
        $totalUsuarios = $usuarioModel->count();
        $totalProductos = $productoModel->count();
        $valorTotal = $productoModel->getTotalValue();
        $precioPromedio = $productoModel->getAvgPrice();
        
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        
        $pdf->Cell(0, 10, 'REPORTE RESUMEN DEL SISTEMA', 0, 1, 'C');
        $pdf->Ln(10);
        
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'Estadisticas Generales', 0, 1, 'L');
        $pdf->Ln(5);
        
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 8, 'Total de Usuarios:', 1, 0, 'L');
        $pdf->Cell(40, 8, $totalUsuarios, 1, 1, 'C');
        
        $pdf->Cell(60, 8, 'Total de Productos:', 1, 0, 'L');
        $pdf->Cell(40, 8, $totalProductos, 1, 1, 'C');
        
        $pdf->Cell(60, 8, 'Valor Total Inventario:', 1, 0, 'L');
        $pdf->Cell(40, 8, 'S/. ' . number_format($valorTotal, 2), 1, 1, 'C');
        
        $pdf->Cell(60, 8, 'Precio Promedio:', 1, 0, 'L');
        $pdf->Cell(40, 8, 'S/. ' . number_format($precioPromedio, 2), 1, 1, 'C');
        
        $pdf->Ln(10);
        
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(0, 5, 'Reporte generado el: ' . date('d/m/Y H:i:s'), 0, 1, 'R');
        
        $pdf->Output('D', 'reporte_resumen_' . date('Y-m-d') . '.pdf');
    }
    
    public function pdfUsuarios() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->readAll()->fetchAll(PDO::FETCH_ASSOC);
        
        // Crear PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        
        // Título
        $pdf->Cell(0, 10, 'REPORTE DE USUARIOS', 0, 1, 'C');
        $pdf->Ln(10);
        
        // Encabezados de tabla
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 8, 'ID', 1, 0, 'C');
        $pdf->Cell(50, 8, 'Usuario', 1, 0, 'C');
        $pdf->Cell(80, 8, 'Nombre Completo', 1, 0, 'C');
        $pdf->Cell(30, 8, 'Estado', 1, 1, 'C');
        
        // Datos de usuarios
        $pdf->SetFont('Arial', '', 9);
        foreach ($usuarios as $usuario) {
            $pdf->Cell(20, 6, $usuario['id'], 1, 0, 'C');
            $pdf->Cell(50, 6, substr($usuario['usuario'], 0, 20), 1, 0, 'L');
            $pdf->Cell(80, 6, substr($usuario['nombre'], 0, 35), 1, 0, 'L');
            $pdf->Cell(30, 6, 'Activo', 1, 1, 'C');
        }
        
        $pdf->Ln(10);
        
        // Total de registros
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 8, 'Total de usuarios: ' . count($usuarios), 0, 1, 'L');
        
        // Fecha de generación
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(0, 5, 'Reporte generado el: ' . date('d/m/Y H:i:s'), 0, 1, 'R');
        
        // Salida del PDF
        $pdf->Output('D', 'reporte_usuarios_' . date('Y-m-d') . '.pdf');
    }
    
     public function pdfProductos() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $productoModel = new Producto();
        $productos = $productoModel->readAll()->fetchAll(PDO::FETCH_ASSOC);
        
        // Crear PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        
        // Título
        $pdf->Cell(0, 10, 'REPORTE DE PRODUCTOS', 0, 1, 'C');
        $pdf->Ln(10);
        
        // Encabezados de tabla
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(15, 8, 'ID', 1, 0, 'C');
        $pdf->Cell(60, 8, 'Nombre', 1, 0, 'C');
        $pdf->Cell(50, 8, 'Descripcion', 1, 0, 'C');
        $pdf->Cell(25, 8, 'Precio', 1, 0, 'C');
        $pdf->Cell(20, 8, 'Stock', 1, 0, 'C');
        $pdf->Cell(20, 8, 'Estado', 1, 1, 'C');
        
        // Datos de productos
        $pdf->SetFont('Arial', '', 8);
        foreach ($productos as $producto) {
            $pdf->Cell(15, 6, $producto['id'], 1, 0, 'C');
            $pdf->Cell(60, 6, substr($producto['nombre'], 0, 25), 1, 0, 'L');
            $pdf->Cell(50, 6, substr($producto['descripcion'], 0, 20), 1, 0, 'L');
            $pdf->Cell(25, 6, 'S/. ' . number_format($producto['precio'], 2), 1, 0, 'R');
            $pdf->Cell(20, 6, $producto['stock'], 1, 0, 'C');
            $pdf->Cell(20, 6, 'Activo', 1, 1, 'C');
        }
        
        $pdf->Ln(10);
        
        // Estadísticas
        $valorTotal = $productoModel->getTotalValue();
        $precioPromedio = $productoModel->getAvgPrice();
        
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 6, 'Total de productos: ' . count($productos), 0, 1, 'L');
        $pdf->Cell(0, 6, 'Valor total del inventario: S/. ' . number_format($valorTotal, 2), 0, 1, 'L');
        $pdf->Cell(0, 6, 'Precio promedio: S/. ' . number_format($precioPromedio, 2), 0, 1, 'L');
        
        // Fecha de generación
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(0, 5, 'Reporte generado el: ' . date('d/m/Y H:i:s'), 0, 1, 'R');
        
        // Salida del PDF
        $pdf->Output('D', 'reporte_productos_' . date('Y-m-d') . '.pdf');
    }
    
    public function pdfGraficos() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        // Obtener datos para reportes
        $usuarioModel = new Usuario();
        $productoModel = new Producto();
        
        $totalUsuarios = $usuarioModel->count();
        $totalProductos = $productoModel->count();
        $valorTotal = $productoModel->getTotalValue();
        $precioPromedio = $productoModel->getAvgPrice();
        
        // Crear PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        
        // Título
        $pdf->Cell(0, 10, 'REPORTE DE GRAFICOS Y ESTADISTICAS', 0, 1, 'C');
        $pdf->Ln(10);
        
        // Resumen ejecutivo
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'Resumen Ejecutivo', 0, 1, 'L');
        $pdf->Ln(5);
        
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(0, 6, 'Este reporte presenta un analisis completo del sistema, incluyendo estadisticas de usuarios, productos y tendencias de ventas. Los datos reflejan el estado actual del inventario y la actividad del sistema.');
        $pdf->Ln(10);
        
        // Estadísticas principales
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'Estadisticas Principales', 0, 1, 'L');
        $pdf->Ln(5);
        
        // Crear tabla de estadísticas
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(80, 8, 'Metrica', 1, 0, 'C');
        $pdf->Cell(40, 8, 'Valor', 1, 0, 'C');
        $pdf->Cell(60, 8, 'Observaciones', 1, 1, 'C');
        
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(80, 6, 'Total de Usuarios Registrados', 1, 0, 'L');
        $pdf->Cell(40, 6, $totalUsuarios, 1, 0, 'C');
        $pdf->Cell(60, 6, 'Usuarios activos en el sistema', 1, 1, 'L');
        
        $pdf->Cell(80, 6, 'Total de Productos en Inventario', 1, 0, 'L');
        $pdf->Cell(40, 6, $totalProductos, 1, 0, 'C');
        $pdf->Cell(60, 6, 'Productos disponibles', 1, 1, 'L');
        
        $pdf->Cell(80, 6, 'Valor Total del Inventario', 1, 0, 'L');
        $pdf->Cell(40, 6, 'S/. ' . number_format($valorTotal, 2), 1, 0, 'C');
        $pdf->Cell(60, 6, 'Valor monetario total', 1, 1, 'L');
        
        $pdf->Cell(80, 6, 'Precio Promedio por Producto', 1, 0, 'L');
        $pdf->Cell(40, 6, 'S/. ' . number_format($precioPromedio, 2), 1, 0, 'C');
        $pdf->Cell(60, 6, 'Precio medio del inventario', 1, 1, 'L');
        
        $pdf->Ln(10);
        
        // Análisis de gráficos
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'Analisis de Graficos Disponibles', 0, 1, 'L');
        $pdf->Ln(5);
        
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(0, 6, '1. Grafico de Barras - Precios de Productos: Muestra la distribucion de precios por producto, permitiendo identificar los productos mas costosos y economicos del inventario.');
        $pdf->Ln(3);
        
        $pdf->MultiCell(0, 6, '2. Grafico Circular - Distribucion del Sistema: Presenta la proporcion entre usuarios y productos registrados en el sistema, ofreciendo una vista general de la composicion.');
        $pdf->Ln(3);
        
        $pdf->MultiCell(0, 6, '3. Grafico de Lineas - Tendencia de Ventas: Simula la tendencia de ventas a lo largo de 6 meses, proporcionando insights sobre el comportamiento comercial.');
        $pdf->Ln(10);
        
        // Recomendaciones
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'Recomendaciones', 0, 1, 'L');
        $pdf->Ln(5);
        
        $pdf->SetFont('Arial', '', 10);
        if ($totalProductos > $totalUsuarios * 5) {
            $pdf->MultiCell(0, 6, '• El inventario tiene una buena variedad de productos. Considere estrategias de marketing para aumentar la base de usuarios.');
        } else {
            $pdf->MultiCell(0, 6, '• Considere ampliar el catalogo de productos para ofrecer mas opciones a los usuarios.');
        }
        $pdf->Ln(3);
        
        if ($precioPromedio > 100) {
            $pdf->MultiCell(0, 6, '• El precio promedio es elevado. Evalúe incluir productos de menor costo para diversificar el mercado.');
        } else {
            $pdf->MultiCell(0, 6, '• Los precios son accesibles. Considere estrategias de valor agregado para productos premium.');
        }
        
        $pdf->Ln(10);
        
        // Fecha de generación
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(0, 5, 'Reporte generado el: ' . date('d/m/Y H:i:s'), 0, 1, 'R');
        
        // Salida del PDF
        $pdf->Output('D', 'reporte_graficos_' . date('Y-m-d') . '.pdf');
    }
}
?>