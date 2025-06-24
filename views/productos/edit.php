<?php
$title = 'Editar Producto - Sistema MVC';
$pageTitle = 'Editar Producto';

ob_start();
?>

<div class="card">
    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
        <a href="/mvcwebi/productos" class="btn btn-outlined btn-icon">
            <span class="material-icons">arrow_back</span>
        </a>
        <h2 class="card-title" style="margin-bottom: 0;">Editar Producto</h2>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <span class="material-icons">error</span>
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/mvcwebi/productos/edit?id=<?php echo $producto->id; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombre" class="form-label">
                <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">inventory</span>
                Nombre del Producto
            </label>
            <input type="text" 
                   id="nombre" 
                   name="nombre" 
                   class="form-input" 
                   placeholder="Ingresa el nombre del producto"
                   value="<?php echo htmlspecialchars($_POST['nombre'] ?? $producto->nombre); ?>"
                   required>
        </div>

        <div class="form-group">
            <label for="precio" class="form-label">
                <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">attach_money</span>
                Precio
            </label>
            <input type="number" 
                   id="precio" 
                   name="precio" 
                   class="form-input" 
                   placeholder="0.00"
                   step="0.01"
                   min="0.01"
                   value="<?php echo htmlspecialchars($_POST['precio'] ?? $producto->precio); ?>"
                   required>
        </div>

        <div class="form-group">
            <label for="foto" class="form-label">
                <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">image</span>
                Imagen del Producto
            </label>
            <?php if (!empty($producto->foto) && file_exists($producto->foto)): ?>
                <div style="margin-bottom: 12px;">
                    <img src="/mvcwebi/<?php echo htmlspecialchars($producto->foto); ?>" 
                         alt="<?php echo htmlspecialchars($producto->nombre); ?>"
                         style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 2px solid var(--md-sys-color-outline);">
                    <p style="color: var(--md-sys-color-on-surface-variant); font-size: 12px; margin-top: 4px;">Imagen actual</p>
                </div>
            <?php endif; ?>
            <input type="file" 
                   id="foto" 
                   name="foto" 
                   class="form-input" 
                   accept="image/*">
            <small style="color: var(--md-sys-color-on-surface-variant); font-size: 12px; margin-top: 4px; display: block;">
                Formatos permitidos: JPG, JPEG, PNG, GIF. Tamaño máximo: 5MB. Deja vacío para mantener la imagen actual.
            </small>
        </div>

        <div class="form-group">
            <label for="estado" class="form-label">
                <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">toggle_on</span>
                Estado
            </label>
            <select id="estado" name="estado" class="form-input" required>
                <option value="Habilitado" <?php echo ($_POST['estado'] ?? $producto->estado) == 'Habilitado' ? 'selected' : ''; ?>>Habilitado</option>
                <option value="Deshabilitado" <?php echo ($_POST['estado'] ?? $producto->estado) == 'Deshabilitado' ? 'selected' : ''; ?>>Deshabilitado</option>
            </select>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">
                <span class="material-icons">save</span>
                Actualizar Producto
            </button>
            <a href="/mvcwebi/productos" class="btn btn-outlined">
                <span class="material-icons">cancel</span>
                Cancelar
            </a>
            <?php if ($producto->estado == 'Deshabilitado'): ?>
                <a href="/mvcwebi/productos/enable?id=<?php echo $producto->id; ?>" 
                   class="btn btn-secondary"
                   onclick="return confirm('¿Estás seguro de que deseas habilitar este producto?')">
                    <span class="material-icons">check_circle</span>
                    Habilitar
                </a>
            <?php else: ?>
                <a href="/mvcwebi/productos/delete?id=<?php echo $producto->id; ?>" 
                   class="btn btn-error"
                   onclick="return confirm('¿Estás seguro de que deseas deshabilitar este producto?')">
                    <span class="material-icons">block</span>
                    Deshabilitar
                </a>
            <?php endif; ?>
        </div>
    </form>
</div>

<div class="card">
    <h3 class="card-title">
        <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">history</span>
        Información del Producto
    </h3>
    <div style="background-color: var(--md-sys-color-surface-container-high); padding: 16px; border-radius: 12px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; color: var(--md-sys-color-on-surface-variant);">
            <div><strong>ID:</strong> <?php echo $producto->id; ?></div>
            <div><strong>Nombre actual:</strong> <?php echo htmlspecialchars($producto->nombre); ?></div>
            <div><strong>Precio actual:</strong> S/. <?php echo number_format($producto->precio, 2); ?></div>
            <div><strong>Estado actual:</strong> 
                <span style="background-color: <?php echo $producto->estado == 'Habilitado' ? 'var(--md-sys-color-tertiary-container)' : 'var(--md-sys-color-error-container)'; ?>; color: <?php echo $producto->estado == 'Habilitado' ? 'var(--md-sys-color-on-tertiary-container)' : 'var(--md-sys-color-on-error-container)'; ?>; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500;">
                    <?php echo $producto->estado; ?>
                </span>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'views/layouts/base.php';
?>