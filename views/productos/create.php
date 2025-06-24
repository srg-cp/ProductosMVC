<?php
$title = 'Crear Producto - Sistema MVC';
$pageTitle = 'Crear Nuevo Producto';

ob_start();
?>

<div class="card">
    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
        <a href="/mvcwebi/productos" class="btn btn-outlined btn-icon">
            <span class="material-icons">arrow_back</span>
        </a>
        <h2 class="card-title" style="margin-bottom: 0;">Crear Nuevo Producto</h2>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <span class="material-icons">error</span>
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/mvcwebi/productos/create" enctype="multipart/form-data">
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
                   value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>"
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
                   value="<?php echo htmlspecialchars($_POST['precio'] ?? ''); ?>"
                   required>
        </div>

        <div class="form-group">
            <label for="foto" class="form-label">
                <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">image</span>
                Imagen del Producto
            </label>
            <input type="file" 
                   id="foto" 
                   name="foto" 
                   class="form-input" 
                   accept="image/*">
            <small style="color: var(--md-sys-color-on-surface-variant); font-size: 12px; margin-top: 4px; display: block;">
                Formatos permitidos: JPG, JPEG, PNG, GIF. Tamaño máximo: 5MB
            </small>
        </div>

        <div class="form-group">
            <label for="estado" class="form-label">
                <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">toggle_on</span>
                Estado
            </label>
            <select id="estado" name="estado" class="form-input" required>
                <option value="Habilitado" <?php echo ($_POST['estado'] ?? 'Habilitado') == 'Habilitado' ? 'selected' : ''; ?>>Habilitado</option>
                <option value="Deshabilitado" <?php echo ($_POST['estado'] ?? '') == 'Deshabilitado' ? 'selected' : ''; ?>>Deshabilitado</option>
            </select>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">
                <span class="material-icons">save</span>
                Crear Producto
            </button>
            <a href="/mvcwebi/productos" class="btn btn-outlined">
                <span class="material-icons">cancel</span>
                Cancelar
            </a>
        </div>
    </form>
</div>

<div class="card">
    <h3 class="card-title">
        <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">info</span>
        Información
    </h3>
    <p style="color: var(--md-sys-color-on-surface-variant); margin-bottom: 16px;">
        Complete todos los campos para registrar un nuevo producto en el sistema.
    </p>
    <ul style="color: var(--md-sys-color-on-surface-variant); margin-left: 20px;">
        <li>El nombre del producto es obligatorio</li>
        <li>El precio debe ser mayor a 0</li>
        <li>Use punto (.) como separador decimal</li>
    </ul>
</div>

<?php
$content = ob_get_clean();
include 'views/layouts/base.php';
?>