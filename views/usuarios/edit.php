<?php
$title = 'Editar Usuario - Sistema MVC';
$pageTitle = 'Editar Usuario';

ob_start();
?>

<div class="card">
    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
        <a href="/mvcwebi/usuarios" class="btn btn-outlined btn-icon">
            <span class="material-icons">arrow_back</span>
        </a>
        <h2 class="card-title" style="margin-bottom: 0;">Editar Usuario</h2>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <span class="material-icons">error</span>
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/mvcwebi/usuarios/edit?id=<?php echo $usuario->id; ?>">
        <div class="form-group">
            <label for="usuario" class="form-label">
                <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">account_circle</span>
                Nombre de Usuario
            </label>
            <input type="text" 
                   id="usuario" 
                   name="usuario" 
                   class="form-input" 
                   placeholder="Ingresa el nombre de usuario"
                   value="<?php echo htmlspecialchars($_POST['usuario'] ?? $usuario->usuario); ?>"
                   required>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">
                <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">lock</span>
                Contraseña
            </label>
            <input type="password" 
                   id="password" 
                   name="password" 
                   class="form-input" 
                   placeholder="Ingresa la nueva contraseña"
                   value="<?php echo htmlspecialchars($_POST['password'] ?? $usuario->password); ?>"
                   required>
            <small style="color: var(--md-sys-color-on-surface-variant); font-size: 12px; margin-top: 4px; display: block;">
                Deja la contraseña actual o ingresa una nueva
            </small>
        </div>

        <div class="form-group">
            <label for="nombre" class="form-label">
                <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">person</span>
                Nombre Completo
            </label>
            <input type="text" 
                   id="nombre" 
                   name="nombre" 
                   class="form-input" 
                   placeholder="Ingresa el nombre completo"
                   value="<?php echo htmlspecialchars($_POST['nombre'] ?? $usuario->nombre); ?>"
                   required>
        </div>

        <div class="form-group">
            <label for="estado" class="form-label">
                <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">toggle_on</span>
                Estado
            </label>
            <select id="estado" name="estado" class="form-input" required>
                <option value="Habilitado" <?php echo ($_POST['estado'] ?? $usuario->estado) == 'Habilitado' ? 'selected' : ''; ?>>Habilitado</option>
                <option value="Deshabilitado" <?php echo ($_POST['estado'] ?? $usuario->estado) == 'Deshabilitado' ? 'selected' : ''; ?>>Deshabilitado</option>
            </select>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">
                <span class="material-icons">save</span>
                Actualizar Usuario
            </button>
            <a href="/mvcwebi/usuarios" class="btn btn-outlined">
                <span class="material-icons">cancel</span>
                Cancelar
            </a>
            <?php if ($usuario->estado == 'Deshabilitado'): ?>
                <a href="/mvcwebi/usuarios/enable?id=<?php echo $usuario->id; ?>" 
                   class="btn btn-secondary"
                   onclick="return confirm('¿Estás seguro de que deseas habilitar este usuario?')">
                    <span class="material-icons">check_circle</span>
                    Habilitar
                </a>
            <?php else: ?>
                <a href="/mvcwebi/usuarios/delete?id=<?php echo $usuario->id; ?>" 
                   class="btn btn-error"
                   onclick="return confirm('¿Estás seguro de que deseas deshabilitar este usuario?')">
                    <span class="material-icons">block</span>
                    Deshabilitar
                </a>
            <?php endif; ?>
        </div>
    </form>
</div>

<div class="card">
    <h3 class="card-title">
        <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">info</span>
        Información del Usuario
    </h3>
    <div style="background-color: var(--md-sys-color-surface-container-high); padding: 16px; border-radius: 12px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; color: var(--md-sys-color-on-surface-variant);">
            <div><strong>ID:</strong> <?php echo $usuario->id; ?></div>
            <div><strong>Usuario actual:</strong> <?php echo htmlspecialchars($usuario->usuario); ?></div>
            <div><strong>Nombre actual:</strong> <?php echo htmlspecialchars($usuario->nombre); ?></div>
            <div><strong>Estado actual:</strong> 
                <span style="background-color: <?php echo $usuario->estado == 'Habilitado' ? 'var(--md-sys-color-tertiary-container)' : 'var(--md-sys-color-error-container)'; ?>; color: <?php echo $usuario->estado == 'Habilitado' ? 'var(--md-sys-color-on-tertiary-container)' : 'var(--md-sys-color-on-error-container)'; ?>; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500;">
                    <?php echo $usuario->estado; ?>
                </span>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'views/layouts/base.php';
?>