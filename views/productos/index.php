<?php
$title = 'Productos - Sistema MVC';
$pageTitle = 'Gestión de Productos';

ob_start();
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2 class="card-title" style="margin-bottom: 0;">Lista de Productos</h2>
        <a href="/mvcwebi/productos/create" class="btn btn-primary">
            <span class="material-icons">add</span>
            Agregar Producto
        </a>
    </div>

    <?php if (empty($productos)): ?>
        <div style="text-align: center; padding: 48px; color: var(--md-sys-color-on-surface-variant);">
            <span class="material-icons" style="font-size: 64px; margin-bottom: 16px; opacity: 0.5;">inventory_2</span>
            <p>No hay productos registrados</p>
            <a href="/mvcwebi/productos/create" class="btn btn-primary" style="margin-top: 16px;">
                <span class="material-icons">add</span>
                Agregar Primer Producto
            </a>
        </div>
    <?php else: ?>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['id']); ?></td>
                            <td>
                                <?php if (!empty($producto['foto']) && file_exists($producto['foto'])): ?>
                                    <img src="/mvcwebi/<?php echo htmlspecialchars($producto['foto']); ?>" 
                                         alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                <?php else: ?>
                                    <div style="width: 50px; height: 50px; background-color: var(--md-sys-color-secondary-container); color: var(--md-sys-color-on-secondary-container); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 500;">
                                        <?php echo strtoupper(substr($producto['nombre'], 0, 1)); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td>
                                <span style="font-weight: 500; color: var(--md-sys-color-primary);">
                                    S/. <?php echo number_format($producto['precio'], 2); ?>
                                </span>
                            </td>
                            <td>
                                <span style="background-color: var(--md-sys-color-tertiary-container); color: var(--md-sys-color-on-tertiary-container); padding: 4px 12px; border-radius: 12px; font-size: 15px; font-weight: 500;">
                                    <?php echo $producto['estado']; ?>
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="/mvcwebi/productos/view?id=<?php echo $producto['id']; ?>" class="btn btn-outlined btn-icon" title="Ver detalles">
                                        <span class="material-icons">visibility</span>
                                    </a>
                                    <a href="/mvcwebi/productos/edit?id=<?php echo $producto['id']; ?>" class="btn btn-outlined btn-icon" title="Editar">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <?php if ($producto['estado'] == 'Deshabilitado'): ?>
                                        <a href="/mvcwebi/productos/enable?id=<?php echo $producto['id']; ?>" 
                                           class="btn btn-secondary btn-icon" 
                                           title="Habilitar"
                                           onclick="return confirm('¿Estás seguro de que deseas habilitar este producto?')">
                                            <span class="material-icons">check_circle</span>
                                        </a>
                                    <?php else: ?>
                                        <a href="/mvcwebi/productos/delete?id=<?php echo $producto['id']; ?>" 
                                           class="btn btn-error btn-icon" 
                                           title="Deshabilitar"
                                           onclick="return confirm('¿Estás seguro de que deseas deshabilitar este producto?')">
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
        
        <div style="margin-top: 16px; padding: 16px; background-color: var(--md-sys-color-surface-container-high); border-radius: 12px; color: var(--md-sys-color-on-surface-variant); font-size: 14px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
                <div><strong>Total de productos:</strong> <?php echo count($productos); ?></div>
                <div><strong>Valor total:</strong> S/. <?php echo number_format(array_sum(array_column($productos, 'precio')), 2); ?></div>
                <div><strong>Precio promedio:</strong> S/. <?php echo count($productos) > 0 ? number_format(array_sum(array_column($productos, 'precio')) / count($productos), 2) : '0.00'; ?></div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include 'views/layouts/base.php';
?>