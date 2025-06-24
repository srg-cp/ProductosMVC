<?php
require_once 'config/Database.php';
require_once 'models/Usuario.php';
require_once 'models/Producto.php';
require_once 'controllers/AuthController.php';

// jpgraph
require_once 'libs/jpgraph/src/jpgraph.php';
require_once 'libs/jpgraph/src/jpgraph_bar.php';
require_once 'libs/jpgraph/src/jpgraph_pie.php';
require_once 'libs/jpgraph/src/jpgraph_line.php';

class GraficoController {
    
    public function barraProductos() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $productoModel = new Producto();
        $productos = $productoModel->readAll()->fetchAll(PDO::FETCH_ASSOC);
        
        $nombres = [];
        $precios = [];
        
        foreach($productos as $producto) {
            $nombres[] = substr($producto['nombre'], 0, 10) . '...';
            $precios[] = floatval($producto['precio']);
        }
        
        // Crear el gráfico
        $graph = new Graph(800, 400);
        $graph->SetScale('textlin');
        $graph->SetMargin(60, 30, 50, 80);
        
        $graph->title->Set('Precios de Productos');
        $graph->title->SetFont(FF_ARIAL, FS_BOLD, 16);
        
        $graph->xaxis->SetTickLabels($nombres);
        $graph->xaxis->SetLabelAngle(45);
        $graph->yaxis->title->Set('Precio (S/)');
        
        $bplot = new BarPlot($precios);
        $bplot->SetFillColor('#6750A4');
        $bplot->SetColor('#6750A4');
        
        $graph->Add($bplot);
        
        header('Content-Type: image/png');
        $graph->Stroke();
    }
    
    public function pieEstadisticas() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $usuarioModel = new Usuario();
        $productoModel = new Producto();
        
        $totalUsuarios = $usuarioModel->count();
        $totalProductos = $productoModel->count();
        
        $data = [$totalUsuarios, $totalProductos];
        $labels = ['Usuarios (' . $totalUsuarios . ')', 'Productos (' . $totalProductos . ')'];
        
        $graph = new PieGraph(400, 300);
        $graph->SetShadow();
        
        $graph->title->Set('Distribución del Sistema');
        $graph->title->SetFont(FF_ARIAL, FS_BOLD, 14);
        
        $p1 = new PiePlot($data);
        $p1->SetLegends($labels);
        $p1->SetSliceColors(['#6750A4', '#625B71']);
        
        $graph->Add($p1);
        
        header('Content-Type: image/png');
        $graph->Stroke();
    }
    
    public function lineaTendencia() {
        $auth = new AuthController();
        $auth->checkAuth();
        
        $productoModel = new Producto();
        $productos = $productoModel->readAll()->fetchAll(PDO::FETCH_ASSOC);
        
        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'];
        $ventas = [];
        
        for($i = 0; $i < 6; $i++) {
            $ventas[] = rand(count($productos) * 10, count($productos) * 50);
        }
        
        // Crear el gráfico
        $graph = new Graph(600, 300);
        $graph->SetScale('textlin');
        $graph->SetMargin(50, 30, 50, 50);
        
        $graph->title->Set('Tendencia de Ventas (Simulada)');
        $graph->title->SetFont(FF_ARIAL, FS_BOLD, 14);
        
        $graph->xaxis->SetTickLabels($meses);
        $graph->yaxis->title->Set('Cantidad');
        
        // Crear línea
        $lineplot = new LinePlot($ventas);
        $lineplot->SetColor('#6750A4');
        $lineplot->SetWeight(3);
        $lineplot->mark->SetType(MARK_FILLEDCIRCLE);
        $lineplot->mark->SetFillColor('#6750A4');
        $lineplot->mark->SetWidth(6);
        
        $graph->Add($lineplot);
        
        header('Content-Type: image/png');
        $graph->Stroke();
    }
}
?>