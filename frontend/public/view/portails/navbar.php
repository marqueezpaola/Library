<link rel="stylesheet" href="/library/frontend/public/assets/css/layout/navbar.css">

<header class="navbar">
    <nav class="navbar__container">

        <!-- BRAND / LOGO -->
        <div class="navbar__brand">
            <div class="navbar__logo-wrapper">
                <img 
                    src="/library/frontend/public/assets/img/HFP_LOGO.png"
                    alt="Logo Biblioteca"
                    class="navbar__logo"
                >
            </div>

            <div class="navbar__text">
                <span class="navbar__title">Biblioteca Roberto Ichazu</span>
                <span class="navbar__subtitle">Colegio Hermano Felipe Palazón</span>
            </div>
        </div>

        <!-- BOTÓN RESPONSIVE -->
        <button
            class="navbar__toggle"
            type="button"
            data-nav-toggle
            aria-label="Abrir menú"
            aria-expanded="false"
        >
            <svg class="navbar__toggle-icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M4 6h16v2H4zM4 11h16v2H4zM4 16h16v2H4z"></path>
            </svg>
        </button>

        <!-- ENLACES -->
        <div class="navbar__links navbar__menu" data-nav-menu>
            <a href="/library/frontend/public/pages/auth/login.php" class="navbar__link">
                Iniciar sesión
            </a>
        </div>

    </nav>
</header>

<script defer src="/library/frontend/public/assets/js/layout/navbar.js"></script>
