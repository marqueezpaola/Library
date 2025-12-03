<?php
// Vista estática del catálogo público (solo maquetación)
?>
<link rel="stylesheet" href="../../assets/css/catalogo.css">

<header>
    <?php include __DIR__ . '/../../view/portails/navbar.php'; ?>
</header>

<section class="catalog">
    <!-- Header -->
    <header class="catalog__header">
        <div class="catalog__title-wrap">
            <h1 class="catalog__title">Catálogo de Libros</h1>
            <p class="catalog__subtitle">Descubre y explora nuestra colección completa</p>
        </div>
        <div class="catalog__meta">
            <span class="catalog__meta-text">0 libros disponibles</span>
        </div>
    </header>

    <!-- Barra de búsqueda -->
    <div class="catalog__search">
        <!-- onsubmit="return false" para que no haga nada -->
        <form class="searchbar" action="#" method="get" onsubmit="return false;">
            <span class="searchbar__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" class="i-24">
                    <path d="M10.5 3a7.5 7.5 0 0 1 5.93 12.22l3.18 3.18a1 1 0 0 1-1.42 1.42l-3.18-3.18A7.5 7.5 0 1 1 10.5 3zm0 2a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11z"/>
                </svg>
            </span>

            <input
                type="text"
                class="searchbar__input"
                placeholder="Buscar por título, autor, ISBN o género…"
                aria-label="Buscar libros">

            <button class="searchbar__addon" type="button" aria-label="Abrir filtros">
                <svg viewBox="0 0 24 24" class="i-20">
                    <path d="M3 5a1 1 0 0 1 1-1h16a1 1 0 0 1 .8 1.6l-5.8 7.73V20a1 1 0 0 1-1.45.9l-4-2A1 1 0 0 1 9 18v-5.67L3.2 5.6A1 1 0 0 1 3 5z"/>
                </svg>
            </button>

            <button class="btn btn--primary searchbar__submit" type="button">
                Buscar
            </button>
        </form>
    </div>

    <!-- Filtros (solo visual, sin lógica) -->
    <div class="catalog__filters">
        <button class="filter-chip" type="button">
            Todas las categorías <span class="filter-chip__caret">▾</span>
        </button>
        <button class="filter-chip" type="button">
            Todos los autores <span class="filter-chip__caret">▾</span>
        </button>
        <button class="filter-chip" type="button">
            Todos los estados <span class="filter-chip__caret">▾</span>
        </button>
        <button class="filter-chip" type="button">
            Título A–Z <span class="filter-chip__caret">▾</span>
        </button>
        <button class="filter-link" type="button">Limpiar</button>

        <div class="filters__right">
            <label class="select-inline">
                <span class="select-inline__label">Ver:</span>
                <select class="select-inline__control">
                    <option selected>24</option>
                    <option>48</option>
                    <option>96</option>
                </select>
            </label>
        </div>
    </div>

    <!-- Info de resultados -->
    <div class="catalog__resultinfo">
        Mostrando 0–0 de 0 resultados
    </div>

    <!-- Grid / estado vacío -->
    <div class="catalog__grid">
        <div class="catalog__empty">
            No se encontraron resultados.
        </div>
    </div>

    <!-- Paginación (solo decorativa) -->
    <nav class="catalog__pagination" aria-label="Paginación">
        <button class="page-btn" type="button" aria-label="Anterior" disabled>‹</button>
        <button class="page-btn is-active" type="button">1</button>
        <button class="page-btn" type="button" aria-label="Siguiente" disabled>›</button>
    </nav>
</section>


<script defer src="/library/frontend/public/assets/js/catalogo.js"></script>

