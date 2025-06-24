<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema MVC</title>
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background-color: var(--md-sys-color-surface-container);
            padding: 32px;
            border-radius: 28px;
            box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12);
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-title {
            font-size: 32px;
            font-weight: 400;
            color: var(--md-sys-color-on-surface);
            margin-bottom: 8px;
        }

        .login-subtitle {
            font-size: 16px;
            color: var(--md-sys-color-on-surface-variant);
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
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

        .form-input::placeholder {
            color: var(--md-sys-color-on-surface-variant);
        }

        .btn-primary {
            width: 100%;
            padding: 16px;
            background-color: var(--md-sys-color-primary);
            color: var(--md-sys-color-on-primary);
            border: none;
            border-radius: 20px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.1px;
        }

        .btn-primary:hover {
            background-color: #7C4DFF;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.14), 0 3px 4px 0 rgba(0, 0, 0, 0.12);
        }

        .error-message {
            background-color: var(--md-sys-color-error-container);
            color: var(--md-sys-color-on-error-container);
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 64px;
            height: 64px;
            background-color: var(--md-sys-color-primary);
            color: var(--md-sys-color-on-primary);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .material-icons {
            font-size: 32px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <div class="logo-icon">
                <span class="material-icons">dashboard</span>
            </div>
        </div>
        
        <div class="login-header">
            <h1 class="login-title">Bienvenido</h1>
            <p class="login-subtitle">Ingresa tus credenciales para continuar</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="error-message">
                <span class="material-icons">error</span>
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <input type="text" name="usuario" class="form-input" placeholder="Usuario" required>
            </div>
            
            <div class="form-group">
                <input type="password" name="password" class="form-input" placeholder="Contraseña" required>
            </div>
            
            <button type="submit" class="btn-primary">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>