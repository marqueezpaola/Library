<?php
// sidebarlibrary_admin.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sidebar Admin Biblioteca</title>

    <!-- Google Fonts: Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
        rel="stylesheet"
    >

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    >

    <!-- CSS propio -->
    <link
        rel="stylesheet"
        href="/library/frontend/public/assets/css/admin/sidebarlibrary_admin.css"
    >
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar-wrapper" id="sidebarWrapper">
        <div class="sidebar-panel">

            <!-- Marca / logo -->
<div class="sidebar-brand" id="sidebarBrand">
    <span class="brand-mark">
        <img src="/library/frontend/public/assets/img/HFP_LOGO.png"
             alt="Biblioteca Roberto Echazu">
    </span>
    <div class="brand-text">
        <span class="brand-line">Biblioteca</span>
        <span class="brand-line">Roberto Echazu</span>
    </div>
</div>


            <!-- Navegación centrada -->
            <div class="sidebar-nav">
                <div class="sidebar-group">
                    <div class="sidebar-section-title">GENERAL</div>

                    <a href="#" class="sidebar-item">
                        <i class="bi bi-journal-richtext"></i>
                        <span>Catálogo</span>
                    </a>

                    <a href="#" class="sidebar-item">
                        <i class="bi bi-speedometer2"></i>
                        <span>Panel de control</span>
                    </a>

                    <a href="#" class="sidebar-item">
                        <i class="bi bi-bookshelf"></i>
                        <span>Gestión de libros</span>
                    </a>

                    <a href="#" class="sidebar-item">
                        <i class="bi bi-calendar-check"></i>
                        <span>Reservas</span>
                    </a>

                    <a href="#" class="sidebar-item">
                        <i class="bi bi-bar-chart-line"></i>
                        <span>Reportes</span>
                    </a>
                </div>

                <div class="sidebar-group">
                    <div class="sidebar-section-title">HERRAMIENTAS</div>

                    <a href="#" class="sidebar-item">
                        <i class="bi bi-question-circle"></i>
                        <span>Ayuda</span>
                    </a>
                </div>
            </div>

            <!-- Pie: cerrar sesión + contraer -->
            <div class="sidebar-footer">
                <a href="#" class="sidebar-item sidebar-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Cerrar sesión</span>
                </a>

                <button class="sidebar-item sidebar-collapse" id="toggleSidebar" type="button">
                    <i class="bi bi-chevron-left"></i>
                    <span>Contraer</span>
                </button>
            </div>
        </div>
    </aside>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS propio -->
    <script src="/library/frontend/public/assets/js/admin/sidebarlibrary_admin.js"></script>
</body>
</html>
