<?php
$title = 'Reportes - Sistema MVC';
$pageTitle = 'Reportes del Sistema';

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

<!-- Reporte de Usuarios -->
<div class="card">
    <h2 class="card-title">
        <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">people</span>
        Reporte de Usuarios
    </h2>
    
    <?php if (empty($reportData['usuarios'])): ?>
        <div style="text-align: center; padding: 48px; color: var(--md-sys-color-on-surface-variant);">
            <span class="material-icons" style="font-size: 64px; margin-bottom: 16px; opacity: 0.5;">people_outline</span>
            <p>No hay usuarios registrados en el sistema</p>
        </div>
    <?php else: ?>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Nombre Completo</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reportData['usuarios'] as $usuario): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div class="user-avatar" style="width: 32px; height: 32px; font-size: 14px;">
                                        <?php echo strtoupper(substr($usuario['nombre'], 0, 1)); ?>
                                    </div>
                                    <?php echo htmlspecialchars($usuario['usuario']); ?>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                            <td>
                                <span style="background-color: var(--md-sys-color-tertiary-container); color: var(--md-sys-color-on-tertiary-container); padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500;">
                                    Activo
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 16px; padding: 16px; background-color: var(--md-sys-color-surface-container-high); border-radius: 12px; color: var(--md-sys-color-on-surface-variant); font-size: 14px;">
            <strong>Total de registros:</strong> <?php echo count($reportData['usuarios']); ?> usuarios
        </div>
    <?php endif; ?>
</div>

<!-- Reporte de Productos -->
<div class="card">
    <h2 class="card-title">
        <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">inventory</span>
        Reporte de Productos
    </h2>
    
    <?php if (empty($reportData['productos'])): ?>
        <div style="text-align: center; padding: 48px; color: var(--md-sys-color-on-surface-variant);">
            <span class="material-icons" style="font-size: 64px; margin-bottom: 16px; opacity: 0.5;">inventory_2</span>
            <p>No hay productos registrados en el sistema</p>
        </div>
    <?php else: ?>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Producto</th>
                        <th>Precio</th>
                        <th>Categoría</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reportData['productos'] as $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['id']); ?></td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 32px; height: 32px; background-color: var(--md-sys-color-secondary-container); color: var(--md-sys-color-on-secondary-container); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 500;">
                                        <?php echo strtoupper(substr($producto['nombre'], 0, 1)); ?>
                                    </div>
                                    <?php echo htmlspecialchars($producto['nombre']); ?>
                                </div>
                            </td>
                            <td>
                                <span style="font-weight: 500; color: var(--md-sys-color-primary);">
                                    S/. <?php echo number_format($producto['precio'], 2); ?>
                                </span>
                            </td>
                            <td>
                                <span style="background-color: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container); padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500;">
                                    General
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 16px; padding: 16px; background-color: var(--md-sys-color-surface-container-high); border-radius: 12px; color: var(--md-sys-color-on-surface-variant); font-size: 14px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
                <div><strong>Total de productos:</strong> <?php echo count($reportData['productos']); ?></div>
                <div><strong>Valor total:</strong> S/. <?php echo number_format($reportData['resumen']['valor_total'], 2); ?></div>
                <div><strong>Precio promedio:</strong> S/. <?php echo number_format($reportData['resumen']['precio_promedio'], 2); ?></div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Acciones de Reporte -->
<div class="card">
    <h2 class="card-title">
        <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">file_download</span>
        Exportar Reportes
    </h2>
    
    <p style="color: var(--md-sys-color-on-surface-variant); margin-bottom: 24px;">
        Descarga los reportes en diferentes formatos para análisis externos.
    </p>
    
    <div class="btn-group">
        <button class="btn btn-primary" onclick="window.print()">
            <span class="material-icons">print</span>
            Imprimir Reporte
        </button>
        
        <button class="btn btn-outlined" onclick="exportToCSV('usuarios')">
            <span class="material-icons">table_view</span>
            Exportar Usuarios (CSV)
        </button>
        
        <button class="btn btn-outlined" onclick="exportToCSV('productos')">
            <span class="material-icons">inventory</span>
            Exportar Productos (CSV)
        </button>
    </div>
</div>

<div class="card">
    <div class="btn-group">
        <a href="/mvcwebi/reportes" class="btn btn-primary">
            <span class="material-icons">table_view</span>
            Vista de Tablas
        </a>
        <a href="/mvcwebi/reportes/graficos" class="btn btn-outlined">
            <span class="material-icons">bar_chart</span>
            Vista de Gráficos
        </a>
    </div>
</div>

<script>
function exportToCSV(type) {
    let csvContent = "";
    let filename = "";
    
    if (type === 'usuarios') {
        csvContent = "ID,Usuario,Nombre Completo\n";
        <?php foreach ($reportData['usuarios'] as $usuario): ?>
        csvContent += "<?php echo $usuario['id']; ?>,<?php echo addslashes($usuario['usuario']); ?>,<?php echo addslashes($usuario['nombre']); ?>\n";
        <?php endforeach; ?>
        filename = "reporte_usuarios_" + new Date().toISOString().slice(0,10) + ".csv";
    } else if (type === 'productos') {
        csvContent = "ID,Nombre,Precio\n";
        <?php foreach ($reportData['productos'] as $producto): ?>
        csvContent += "<?php echo $producto['id']; ?>,<?php echo addslashes($producto['nombre']); ?>,<?php echo $producto['precio']; ?>\n";
        <?php endforeach; ?>
        filename = "reporte_productos_" + new Date().toISOString().slice(0,10) + ".csv";
    }
    
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement("a");
    const url = URL.createObjectURL(blob);
    link.setAttribute("href", url);
    link.setAttribute("download", filename);
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>

<?php
$content = ob_get_clean();
include 'views/layouts/base.php';
?>