<?php
$title = 'Dashboard - Sistema MVC';
$pageTitle = 'Dashboard';

ob_start();
?>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container);">
            <span class="material-icons">people</span>
        </div>
        <div class="stat-value"><?php echo $stats['usuarios']; ?></div>
        <div class="stat-label">Total Usuarios</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: var(--md-sys-color-secondary-container); color: var(--md-sys-color-on-secondary-container);">
            <span class="material-icons">inventory</span>
        </div>
        <div class="stat-value"><?php echo $stats['productos']; ?></div>
        <div class="stat-label">Total Productos</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: var(--md-sys-color-tertiary-container); color: var(--md-sys-color-on-tertiary-container);">
            <span class="material-icons">attach_money</span>
        </div>
        <div class="stat-value">S/. <?php echo number_format($stats['valor_total'], 2); ?></div>
        <div class="stat-label">Valor Total Inventario</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container);">
            <span class="material-icons">trending_up</span>
        </div>
        <div class="stat-value">S/. <?php echo number_format($stats['precio_promedio'], 2); ?></div>
        <div class="stat-label">Precio Promedio</div>
    </div>
</div>

<div class="card">
    <h2 class="card-title">Resumen del Sistema</h2>
    <p style="color: var(--md-sys-color-on-surface-variant); margin-bottom: 24px;">
        Bienvenido al panel de administración. Aquí puedes gestionar usuarios, productos y generar reportes del sistema.
    </p>
    
    <div class="btn-group">
        <a href="/mvcwebi/usuarios" class="btn btn-primary">
            <span class="material-icons">people</span>
            Ver Usuarios
        </a>
        
        <a href="/mvcwebi/productos" class="btn btn-secondary">
            <span class="material-icons">inventory</span>
            Ver Productos
        </a>
        
        <a href="/mvcwebi/reportes" class="btn btn-outlined">
            <span class="material-icons">analytics</span>
            Ver Reportes
        </a>
    </div>
</div>

<div class="stats-grid">
    <div class="card">
        <h3 class="card-title">Acciones Rápidas</h3>
        <div style="display: flex; flex-direction: column; gap: 12px;">
            <a href="/mvcwebi/usuarios/create" class="btn btn-outlined">
                <span class="material-icons">person_add</span>
                Nuevo Usuario
            </a>
            <a href="/mvcwebi/productos/create" class="btn btn-outlined">
                <span class="material-icons">add_box</span>
                Agregar Producto
            </a>
        </div>
    </div>

    <div class="card">
        <h3 class="card-title">Estado del Sistema</h3>
        <div style="display: flex; flex-direction: column; gap: 16px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <span class="material-icons" style="color: #4CAF50;">check_circle</span>
                <span>Base de datos conectada</span>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <span class="material-icons" style="color: #4CAF50;">check_circle</span>
                <span>Sistema funcionando correctamente</span>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <span class="material-icons" style="color: #4CAF50;">check_circle</span>
                <span>Sesión activa</span>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'views/layouts/base.php';
?>