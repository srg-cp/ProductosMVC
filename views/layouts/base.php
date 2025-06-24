<?php
// Función helper para generar URLs
function url($path) {
    return '/mvcwebi' . $path;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Sistema MVC'; ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        :root {
            --md-sys-color-primary: #6750A4;
            --md-sys-color-on-primary: #FFFFFF;
            --md-sys-color-primary-container: #EADDFF;
            --md-sys-color-on-primary-container: #21005D;
            --md-sys-color-secondary: #625B71;
            --md-sys-color-on-secondary: #FFFFFF;
            --md-sys-color-secondary-container: #E8DEF8;
            --md-sys-color-on-secondary-container: #1D192B;
            --md-sys-color-tertiary: #7D5260;
            --md-sys-color-on-tertiary: #FFFFFF;
            --md-sys-color-tertiary-container: #FFD8E4;
            --md-sys-color-on-tertiary-container: #31111D;
            --md-sys-color-error: #BA1A1A;
            --md-sys-color-on-error: #FFFFFF;
            --md-sys-color-error-container: #FFDAD6;
            --md-sys-color-on-error-container: #410002;
            --md-sys-color-background: #1C1B1F;
            --md-sys-color-on-background: #E6E1E5;
            --md-sys-color-surface: #1C1B1F;
            --md-sys-color-on-surface: #E6E1E5;
            --md-sys-color-surface-variant: #49454F;
            --md-sys-color-on-surface-variant: #CAC4D0;
            --md-sys-color-outline: #938F99;
            --md-sys-color-outline-variant: #49454F;
            --md-sys-color-shadow: #000000;
            --md-sys-color-scrim: #000000;
            --md-sys-color-surface-tint: #D0BCFF;
            --md-sys-color-inverse-surface: #E6E1E5;
            --md-sys-color-inverse-on-surface: #313033;
            --md-sys-color-inverse-primary: #6750A4;
            --md-sys-color-surface-container-lowest: #0F0D13;
            --md-sys-color-surface-container-low: #1D1B20;
            --md-sys-color-surface-container: #211F26;
            --md-sys-color-surface-container-high: #2B2930;
            --md-sys-color-surface-container-highest: #36343B;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--md-sys-color-background);
            color: var(--md-sys-color-on-background);
            line-height: 1.5;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background-color: var(--md-sys-color-surface-container);
            border-right: 1px solid var(--md-sys-color-outline-variant);
            padding: 24px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 0 24px 24px;
            border-bottom: 1px solid var(--md-sys-color-outline-variant);
            margin-bottom: 24px;
        }

        .sidebar-title {
            font-size: 22px;
            font-weight: 500;
            color: var(--md-sys-color-on-surface);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-nav {
            padding: 0 12px;
        }

        .nav-item {
            margin-bottom: 4px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            color: var(--md-sys-color-on-surface);
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 400;
        }

        .nav-link:hover {
            background-color: var(--md-sys-color-surface-container-highest);
        }

        .nav-link.active {
            background-color: var(--md-sys-color-secondary-container);
            color: var(--md-sys-color-on-secondary-container);
        }

        .nav-icon {
            font-size: 24px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            background-color: var(--md-sys-color-background);
        }

        /* Top Bar */
        .top-bar {
            background-color: var(--md-sys-color-surface);
            border-bottom: 1px solid var(--md-sys-color-outline-variant);
            padding: 16px 24px;
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .top-bar-title {
            font-size: 24px;
            font-weight: 400;
            color: var(--md-sys-color-on-surface);
        }

        .top-bar-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-left: auto;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--md-sys-color-on-surface);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 20px;
            background-color: var(--md-sys-color-primary);
            color: var(--md-sys-color-on-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
        }

        .btn-logout {
            background-color: var(--md-sys-color-error);
            color: var(--md-sys-color-on-error);
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background-color: #C62828;
        }

        /* Content Area */
        .content {
            padding: 24px;
        }

        /* Cards */
        .card {
            background-color: var(--md-sys-color-surface-container);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12), 0 1px 2px 0 rgba(0, 0, 0, 0.24);
        }

        .card-title {
            font-size: 20px;
            font-weight: 500;
            color: var(--md-sys-color-on-surface);
            margin-bottom: 16px;
        }

        /* Buttons */
        .btn {
            padding: 12px 24px;
            border-radius: 20px;
            border: none;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.1px;
        }

        .btn-primary {
            background-color: var(--md-sys-color-primary);
            color: var(--md-sys-color-on-primary);
        }

        .btn-primary:hover {
            background-color: #7C4DFF;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.14);
        }

        .btn-secondary {
            background-color: var(--md-sys-color-secondary);
            color: var(--md-sys-color-on-secondary);
        }

        .btn-secondary:hover {
            background-color: #7A6F84;
        }

        .btn-error {
            background-color: var(--md-sys-color-error);
            color: var(--md-sys-color-on-error);
        }

        .btn-error:hover {
            background-color: #C62828;
        }

        .btn-outlined {
            background-color: transparent;
            color: var(--md-sys-color-primary);
            border: 1px solid var(--md-sys-color-outline);
        }

        .btn-outlined:hover {
            background-color: var(--md-sys-color-primary-container);
            color: var(--md-sys-color-on-primary-container);
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--md-sys-color-on-surface);
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 16px;
            border: 1px solid var(--md-sys-color-outline);
            border-radius: 12px;
            background-color: var(--md-sys-color-surface-container-highest);
            color: var(--md-sys-color-on-surface);
            font-size: 16px;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--md-sys-color-primary);
            border-width: 2px;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            background-color: var(--md-sys-color-surface-container);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid var(--md-sys-color-outline-variant);
        }

        .table th {
            background-color: var(--md-sys-color-surface-container-high);
            color: var(--md-sys-color-on-surface);
            font-weight: 500;
        }

        .table td {
            color: var(--md-sys-color-on-surface);
        }

        .table tr:hover {
            background-color: var(--md-sys-color-surface-container-highest);
        }

        /* Alerts */
        .alert {
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background-color: var(--md-sys-color-tertiary-container);
            color: var(--md-sys-color-on-tertiary-container);
        }

        .alert-error {
            background-color: var(--md-sys-color-error-container);
            color: var(--md-sys-color-on-error-container);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .main-content {
                margin-left: 0;
            }

            .content {
                padding: 16px;
            }
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background-color: var(--md-sys-color-surface-container);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12), 0 1px 2px 0 rgba(0, 0, 0, 0.24);
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.14), 0 6px 20px 0 rgba(0, 0, 0, 0.12);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            font-size: 24px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 500;
            color: var(--md-sys-color-on-surface);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--md-sys-color-on-surface-variant);
        }

        .btn-group {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-icon {
            padding: 8px;
            border-radius: 8px;
            min-width: auto;
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2 class="sidebar-title">
                    <span class="material-icons">dashboard</span>
                    Sistema MVC
                </h2>
            </div>
            
            <div class="sidebar-nav">
                <div class="nav-item">
                    <a href="/mvcwebi/dashboard" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/mvcwebi/dashboard') ? 'active' : ''; ?>">
                        <span class="material-icons nav-icon">dashboard</span>
                        Dashboard
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="/mvcwebi/usuarios" class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], '/usuarios') !== false) ? 'active' : ''; ?>">
                        <span class="material-icons nav-icon">people</span>
                        Usuarios
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="/mvcwebi/productos" class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], '/productos') !== false) ? 'active' : ''; ?>">
                        <span class="material-icons nav-icon">inventory</span>
                        Productos
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="/mvcwebi/reportes" class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], '/reportes') !== false) ? 'active' : ''; ?>">
                        <span class="material-icons nav-icon">analytics</span>
                        Reportes
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <div class="top-bar">
                <h1 class="top-bar-title"><?php echo $pageTitle ?? 'Dashboard'; ?></h1>
                
                <div class="top-bar-actions">
                    <div class="user-info">
                        <div class="user-avatar">
                            <?php echo strtoupper(substr($_SESSION['user_name'] ?? 'U', 0, 1)); ?>
                        </div>
                        <span><?php echo $_SESSION['user_name'] ?? 'Usuario'; ?></span>
                    </div>
                    
                    <a href="/logout" class="btn-logout">
                        <span class="material-icons">logout</span>
                        Salir
                    </a>
                </div>
            </div>

            <div class="content">
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <span class="material-icons">check_circle</span>
                        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-error">
                        <span class="material-icons">error</span>
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <?php echo $content ?? ''; ?>
            </div>
        </main>
    </div>
</body>
</html>