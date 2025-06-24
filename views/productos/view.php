<?php
$title = 'Detalles del Producto - Sistema MVC';
$pageTitle = 'Detalles del Producto';

ob_start();
?>

<div class="card">
    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
        <a href="/mvcwebi/productos" class="btn btn-outlined btn-icon">
            <span class="material-icons">arrow_back</span>
        </a>
        <h2 class="card-title" style="margin-bottom: 0;">Detalles del Producto</h2>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 24px; align-items: start;">
        <!-- Imagen del producto -->
        <div style="text-align: center;">
            <?php if (!empty($producto->foto) && file_exists($producto->foto)): ?>
                <img src="/mvcwebi/<?php echo htmlspecialchars($producto->foto); ?>" 
                     alt="<?php echo htmlspecialchars($producto->nombre); ?>"
                     style="width: 100%; max-width: 300px; height: auto; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <?php else: ?>
                <div style="width: 100%; max-width: 300px; height: 300px; background-color: var(--md-sys-color-secondary-container); color: var(--md-sys-color-on-secondary-container); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 48px; font-weight: 500; margin: 0 auto;">
                    <?php echo strtoupper(substr($producto->nombre, 0, 1)); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Información del producto -->
        <div>
            <h3 style="margin-bottom: 16px; color: var(--md-sys-color-primary);">
                <?php echo htmlspecialchars($producto->nombre); ?>
            </h3>
            
            <div style="background-color: var(--md-sys-color-surface-container-high); padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                <div style="display: grid; gap: 16px;">
                    <div>
                        <strong style="color: var(--md-sys-color-on-surface);">ID:</strong>
                        <span style="color: var(--md-sys-color-on-surface-variant);"><?php echo $producto->id; ?></span>
                    </div>
                    <div>
                        <strong style="color: var(--md-sys-color-on-surface);">Precio:</strong>
                        <span style="color: var(--md-sys-color-primary); font-size: 24px; font-weight: 600;">
                            S/. <?php echo number_format($producto->precio, 2); ?>
                        </span>
                    </div>
                    <div>
                        <strong style="color: var(--md-sys-color-on-surface);">Estado:</strong>
                        <span class="badge <?php echo $producto->estado == 'Habilitado' ? 'badge-success' : 'badge-error'; ?>">
                            <?php echo $producto->estado; ?>
                        </span>
                    </div>
                    <?php if (!empty($producto->foto)): ?>
                    <div>
                        <strong style="color: var(--md-sys-color-on-surface);">Imagen:</strong>
                        <span style="color: var(--md-sys-color-on-surface-variant);"><?php echo basename($producto->foto); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="btn-group">
                <a href="/mvcwebi/productos/edit?id=<?php echo $producto->id; ?>" class="btn btn-primary">
                    <span class="material-icons">edit</span>
                    Editar Producto
                </a>
                <a href="/mvcwebi/productos" class="btn btn-outlined">
                    <span class="material-icons">list</span>
                    Volver a Lista
                </a>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'views/layouts/base.php';
?>