<?php
$title = 'Reportes con Gráficos - Sistema MVC';
$pageTitle = 'Reportes con Gráficos';

ob_start();
?>

<!-- Tarjetas de Resumen -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container);">
            <span class="material-icons">people</span>
        </div>
        <div class="stat-value"><?php echo $reportData['resumen']['usuarios']; ?></div>
        <div class="stat-label">Total de Usuarios</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: var(--md-sys-color-secondary-container); color: var(--md-sys-color-on-secondary-container);">
            <span class="material-icons">inventory</span>
        </div>
        <div class="stat-value"><?php echo $reportData['resumen']['productos']; ?></div>
        <div class="stat-label">Total de Productos</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: var(--md-sys-color-tertiary-container); color: var(--md-sys-color-on-tertiary-container);">
            <span class="material-icons">attach_money</span>
        </div>
        <div class="stat-value">S/. <?php echo number_format($reportData['resumen']['valor_total'], 2); ?></div>
        <div class="stat-label">Valor Total del Inventario</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container);">
            <span class="material-icons">trending_up</span>
        </div>
        <div class="stat-value">S/. <?php echo number_format($reportData['resumen']['precio_promedio'], 2); ?></div>
        <div class="stat-label">Precio Promedio</div>
    </div>
</div>

<!-- Navegación entre vistas -->
<div class="card">
    <div class="btn-group">
        <a href="/mvcwebi/reportes" class="btn btn-outlined">
            <span class="material-icons">table_view</span>
            Vista de Tablas
        </a>
        <a href="/mvcwebi/reportes/graficos" class="btn btn-primary">
            <span class="material-icons">bar_chart</span>
            Vista de Gráficos
        </a>
    </div>
</div>

<!-- Gráficos -->
<div class="charts-grid">
    <!-- Gráfico de Barras - Precios de Productos -->
    <div class="card">
        <h2 class="card-title">
            <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">bar_chart</span>
            Precios de Productos
        </h2>
        <div class="chart-container">
            <img src="/mvcwebi/graficos/barraProductos" 
                 alt="Gráfico de Precios de Productos" 
                 style="max-width: 100%; height: auto; border-radius: 8px;">
        </div>
    </div>

    <!-- Gráfico Circular - Estadísticas Generales -->
    <div class="card">
        <h2 class="card-title">
            <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">pie_chart</span>
            Distribución del Sistema
        </h2>
        <div class="chart-container">
            <img src="/mvcwebi/graficos/pieEstadisticas" 
                 alt="Gráfico Circular de Estadísticas" 
                 style="max-width: 100%; height: auto; border-radius: 8px;">
        </div>
    </div>

    <!-- Gráfico de Líneas - Tendencia -->
    <div class="card" style="grid-column: 1 / -1;">
        <h2 class="card-title">
            <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">trending_up</span>
            Tendencia de Ventas
        </h2>
        <div class="chart-container">
            <img src="/mvcwebi/graficos/lineaTendencia" 
                 alt="Gráfico de Tendencia de Ventas" 
                 style="max-width: 100%; height: auto; border-radius: 8px;">
        </div>
    </div>
</div>

<div class="card">
    <h2 class="card-title">
        <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">file_download</span>
        Descargar Reportes PDF
    </h2>
    
    <div class="btn-group">
        <a href="/mvcwebi/reportes/pdfResumen" class="btn btn-primary" target="_blank">
            <span class="material-icons">summarize</span>
            Resumen Ejecutivo
        </a>
        <a href="/mvcwebi/reportes/pdfUsuarios" class="btn btn-outlined" target="_blank">
            <span class="material-icons">people</span>
            Reporte de Usuarios
        </a>
        <a href="/mvcwebi/reportes/pdfGraficos" class="btn btn-secondary" target="_blank">
            <span class="material-icons">analytics</span>
            Análisis Completo
        </a>
    </div>
    
    <div style="margin-top: 16px; padding: 16px; background-color: var(--md-sys-color-surface-container-high); border-radius: 12px; color: var(--md-sys-color-on-surface-variant); font-size: 14px;">
        <span class="material-icons" style="vertical-align: middle; margin-right: 8px; font-size: 16px;">info</span>
        <strong>Información:</strong> Los reportes PDF se generan automáticamente con los datos actuales del sistema y se descargan directamente a tu dispositivo.
    </div>
</div>

<div class="btn-group">
    <button class="btn btn-primary" onclick="window.print()">
        <span class="material-icons">print</span>
        Imprimir Reporte
    </button>
    
    <button class="btn btn-outlined" onclick="descargarGrafico('barraProductos')">
        <span class="material-icons">download</span>
        Descargar Gráfico de Barras
    </button>
    
    <button class="btn btn-outlined" onclick="descargarGrafico('pieEstadisticas')">
        <span class="material-icons">download</span>
        Descargar Gráfico Circular
    </button>
    
    <button class="btn btn-outlined" onclick="descargarGrafico('lineaTendencia')">
        <span class="material-icons">download</span>
        Descargar Gráfico de Líneas
    </button>
</div>
</div>

<style>
.charts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 24px;
    margin-bottom: 24px;
}

.chart-container {
    text-align: center;
    padding: 16px;
    background-color: var(--md-sys-color-surface-container);
    border-radius: 12px;
    margin-top: 16px;
}

.chart-container img {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

@media (max-width: 768px) {
    .charts-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function descargarGrafico(tipo) {
    const link = document.createElement('a');
    link.href = '/mvcwebi/graficos/' + tipo;
    link.download = 'grafico_' + tipo + '_' + new Date().toISOString().slice(0,10) + '.png';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>

<?php
$content = ob_get_clean();
include 'views/layouts/base.php';
?>