<?php
// Ruta base pública del proyecto
$baseUrl = '/library/frontend/public';

// ✅ Ruta correcta del logo (a partir de la carpeta public)
$logoUrl = $baseUrl . '/assets/img/HFP_LOGO.png';

// Ruta base de las vistas
$loginViewPath = __DIR__ . '/../../view/login';

// Determinar qué vista mostrar
$step = isset($_GET['step']) ? $_GET['step'] : 'login';

switch ($step) {
    case 'forgot':
        $viewFile = $loginViewPath . '/LoginPassword.php';
        break;
    case 'verify':
        $viewFile = $loginViewPath . '/LoginVerification.php';
        break;
    case 'reset':
        $viewFile = $loginViewPath . '/LoginResetPassword.php';
        break;
    case 'login':
    default:
        $viewFile = $loginViewPath . '/LoginForm.php';
        break;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión | Biblioteca Roberto Ichazu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/login.css">
</head>
<body>

<?php include $viewFile; ?>

<script src="<?= $baseUrl ?>/assets/js/login.js" defer></script>
</body>
</html>
