<?php
$title = 'Crear Usuario - Sistema MVC';
$pageTitle = 'Crear Nuevo Usuario';

ob_start();
?>

<div class="card">
    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
        <a href="/mvcwebi/usuarios" class="btn btn-outlined btn-icon">
            <span class="material-icons">arrow_back</span>
        </a>
        <h2 class="card-title" style="margin-bottom: 0;">Crear Nuevo Usuario</h2>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <span class="material-icons">error</span>
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/mvcwebi/usuarios/create">
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
                   value="<?php echo htmlspecialchars($_POST['usuario'] ?? ''); ?>"
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
                   placeholder="Ingresa la contraseña"
                   required>
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
                   value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>"
                   required>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">
                <span class="material-icons">save</span>
                Crear Usuario
            </button>
            <a href="/mvcwebi/usuarios" class="btn btn-outlined">
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
        Complete todos los campos para registrar un nuevo usuario en el sistema.
    </p>
    <ul style="color: var(--md-sys-color-on-surface-variant); margin-left: 20px;">
        <li>El nombre de usuario debe ser único</li>
        <li>La contraseña debe ser segura</li>
        <li>Todos los campos son obligatorios</li>
    </ul>
</div>

<?php
$content = ob_get_clean();
include 'views/layouts/base.php';
?>