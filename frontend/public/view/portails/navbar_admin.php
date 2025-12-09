<?php
// navbar_admin.php
// Estos valores luego vendrán de BD / sesión:
$userName       = isset($userName) ? $userName : 'Alexander Mark';
$userAvatarUrl  = isset($userAvatarUrl)
    ? $userAvatarUrl
    : '/library/frontend/public/assets/img/default-avatar.png';

// NOTIFICACIONES:
// Cuando tengas controlador/BD, solo tendrás que pasar $notificationCount.
// Si NO se pasa nada, no se muestra badge (nada inventado).
$notificationCount = isset($notificationCount) ? (int)$notificationCount : null;
?>

<!-- CSS DEL NAVBAR -->
<link rel="stylesheet" href="/library/frontend/public/assets/css/admin/navbar_admin.css">

<header class="admin-navbar">
    <div class="admin-navbar-inner">

        <div class="admin-navbar-right">

            <!-- CAMPANA -->
            <button class="admin-navbar-bell" id="adminNavbarBell" type="button">
                <i class="bi bi-bell"></i>

                <?php if ($notificationCount !== null): ?>
                    <span class="admin-navbar-badge">
                        <?php echo $notificationCount; ?>
                    </span>
                <?php endif; ?>

            </button>

            <!-- USUARIO + DROPDOWN -->
            <div class="admin-navbar-user-wrapper">

                <div class="admin-navbar-user">
                    <div class="admin-navbar-avatar">
                        <img src="<?php echo htmlspecialchars($userAvatarUrl); ?>" alt="avatar">
                    </div>

                    <div class="admin-navbar-username">
                        <?php echo htmlspecialchars($userName); ?>
                    </div>

                    <!-- FLECHA -->
                    <i class="bi bi-chevron-down admin-navbar-user-arrow"></i>
                </div>

                <!-- MENU DROPDOWN -->
                <div class="admin-navbar-user-menu">
                    <a href="#" class="admin-navbar-user-menu-item">
                        <i class="bi bi-person"></i>
                        Perfil
                    </a>

                    <a href="#" class="admin-navbar-user-menu-item">
                        <i class="bi bi-gear"></i>
                        Cuenta
                    </a>

                    <a href="#" class="admin-navbar-user-menu-item">
                        <i class="bi bi-clock-history"></i>
                        Historial
                    </a>
                </div>

            </div>
        </div>
    </div>
</header>

<!-- JS SOLO PARA ANIMACIÓN -->
<script src="/library/frontend/public/assets/js/admin/navbar_admin.js"></script>
