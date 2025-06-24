<?php
$title = 'Usuarios - Sistema MVC';
$pageTitle = 'Gestión de Usuarios';

ob_start();
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2 class="card-title" style="margin-bottom: 0;">Lista de Usuarios</h2>
        <a href="/mvcwebi/usuarios/create" class="btn btn-primary">
            <span class="material-icons">person_add</span>
            Agregar Usuario
        </a>
    </div>

    <?php if (empty($usuarios)): ?>
        <div style="text-align: center; padding: 48px; color: var(--md-sys-color-on-surface-variant);">
            <span class="material-icons" style="font-size: 64px; margin-bottom: 16px; opacity: 0.5;">people_outline</span>
            <p>No hay usuarios registrados</p>
            <a href="/mvcwebi/usuarios/create" class="btn btn-primary" style="margin-top: 16px;">
                <span class="material-icons">person_add</span>
                Agregar Primeiro Usuario
            </a>
        </div>
    <?php else: ?>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Nombre Completo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
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
                                <div class="btn-group">
                                    <a href="/mvcwebi/usuarios/edit?id=<?php echo $usuario['id']; ?>" 
                                       class="btn btn-outlined btn-icon" 
                                       title="Editar">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <?php if ($usuario['estado'] == 'Deshabilitado'): ?>
                                        <a href="/mvcwebi/usuarios/enable?id=<?php echo $usuario['id']; ?>" 
                                           class="btn btn-secondary btn-icon" 
                                           title="Habilitar"
                                           onclick="return confirm('¿Estás seguro de que deseas habilitar este usuario?')">
                                            <span class="material-icons">check_circle</span>
                                        </a>
                                    <?php else: ?>
                                        <a href="/mvcwebi/usuarios/delete?id=<?php echo $usuario['id']; ?>" 
                                           class="btn btn-error btn-icon"
                                           title="Deshabilitar"
                                           onclick="return confirm('¿Estás seguro de que deseas deshabilitar este usuario?')">
                                            <span class="material-icons">block</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 24px; padding: 16px; background-color: var(--md-sys-color-surface-container-high); border-radius: 12px;">
            <div style="display: flex; align-items: center; gap: 12px; color: var(--md-sys-color-on-surface-variant);">
                <span class="material-icons">info</span>
                <span>Total de usuarios: <strong><?php echo count($usuarios); ?></strong></span>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include 'views/layouts/base.php';
?>