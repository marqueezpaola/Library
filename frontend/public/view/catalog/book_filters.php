<?php
// C:\xampp\htdocs\library\frontend\public\view\catalog\book_filters.php

// Valores actuales (para que los campos recuerden lo elegido)
$search            = $search            ?? '';
$perPage           = $perPage           ?? 24;

$selectedCategory  = $_GET['category']   ?? ''; // Género
$selectedStatus    = $_GET['status']     ?? ''; // Disponibilidad
$selectedCountry   = $_GET['country']    ?? ''; // Nacionalidad
$selectedLanguage  = $_GET['language']   ?? ''; // Idioma
$pagesMin          = $_GET['pages_min']  ?? ''; // Páginas mínimas
$pagesMax          = $_GET['pages_max']  ?? ''; // Páginas máximas

// Compatibilidad con filtros anteriores (ya no se usan en la UI)
$selectedAuthor    = $_GET['author']     ?? '';
$selectedOrder     = $_GET['order']      ?? 'title_asc';
?>

<!-- Fuente Roboto solo para este bloque -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">


<link rel="stylesheet" href="../../assets/css/catalog/book_filters.css">

<form class="catalog__search" action="" method="get">

    <!-- BARRA DE BÚSQUEDA PRINCIPAL -->
    <div class="searchbar">
        <span class="searchbar__icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" class="i-24">
                <path d="M10.5 3a7.5 7.5 0 0 1 5.93 12.22l3.18 3.18a1 1 0 0 1-1.42 1.42l-3.18-3.18A7.5 7.5 0 1 1 10.5 3zm0 2a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11z"/>
            </svg>
        </span>

        <input
            type="text"
            name="q"
            class="searchbar__input"
            placeholder="Buscar por título, autor, ISBN o género…"
            aria-label="Buscar libros"
            value="<?= htmlspecialchars($search) ?>">

        <!-- Botón para abrir/cerrar filtros -->
        <button
            class="searchbar__addon"
            type="button"
            aria-label="Abrir filtros"
            aria-expanded="false"
            aria-controls="catalogFilters"
            data-filters-toggle
        >
            <svg viewBox="0 0 24 24" class="i-20">
                <path d="M3 5a1 1 0 0 1 1-1h16a1 1 0 0 1 .8 1.6l-5.8 7.73V20a1 1 0 0 1-1.45.9l-4-2A1 1 0 0 1 9 18v-5.67L3.2 5.6A1 1 0 0 1 3 5z"/>
            </svg>
        </button>

        <button class="btn btn--primary searchbar__submit" type="submit">
            Buscar
        </button>
    </div>

    <div class="container">
    <form class="catalog__search" action="" method="get">
    
    </form>
</div>


    <!-- PANEL DE FILTROS DETALLADOS (abre/cierra con el botón de arriba) -->
    <div class="catalog__filters is-collapsed" id="catalogFilters">

        <!-- Línea de título del panel: icono + texto "Filtros" -->
        <div class="filters__header-row">
            <span class="filters__header-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" class="i-18">
                    <path d="M3 5a1 1 0 0 1 1-1h16a1 1 0 0 1 .8 1.6l-5.8 7.73V20a1 1 0 0 1-1.45.9l-4-2A1 1 0 0 1 9 18v-5.67L3.2 5.6A1 1 0 0 1 3 5z"/>
                </svg>
            </span>
            <span class="filters__header-text">Filtros</span>
        </div>

        <!-- FILTROS PRINCIPALES (Género, Disponibilidad, Nacionalidad, Idioma, Páginas) -->
        <div class="filters__row">

            <!-- GÉNERO -->
            <label class="filter-chip filter-chip--dropdown">
                <span class="filter-chip__label">Genero</span>
                <input
                    type="text"
                    name="category"
                    class="filter-chip__input"
                    list="genreOptions"
                    placeholder="Todos"
                    value="<?= htmlspecialchars($selectedCategory) ?>"
                >
                <datalist id="genreOptions">
                    <option value="Fantasía">
                    <option value="Ciencia ficción">
                    <option value="Ciencias">
                    <option value="Historia">
                    <option value="Filosofía">
                    <option value="Biografía">
                </datalist>
            </label>

            <!-- DISPONIBILIDAD -->
            <label class="filter-chip filter-chip--dropdown">
                <span class="filter-chip__label">Disponibilidad</span>
                <select name="status" class="filter-chip__select">
                    <option value=""              <?= $selectedStatus === ''           ? 'selected' : '' ?>>Todos</option>
                    <option value="disponible"    <?= $selectedStatus === 'disponible' ? 'selected' : '' ?>>Disponibles</option>
                    <option value="reservado"     <?= $selectedStatus === 'reservado'  ? 'selected' : '' ?>>Reservados</option>
                    <option value="prestamo"      <?= $selectedStatus === 'prestamo'   ? 'selected' : '' ?>>En préstamo</option>
                </select>
            </label>

            <!-- NACIONALIDAD -->
            <label class="filter-chip filter-chip--dropdown">
                <span class="filter-chip__label">Nacionalidad</span>
                <input
                    type="text"
                    name="country"
                    class="filter-chip__input"
                    list="countryOptions"
                    placeholder="Todos"
                    value="<?= htmlspecialchars($selectedCountry) ?>"
                >
                <datalist id="countryOptions">
                    <option value="Perú">
                    <option value="México">
                    <option value="Argentina">
                    <option value="Chile">
                    <option value="España">
                    <option value="Estados Unidos">
                    <option value="Colombia">
                </datalist>
            </label>

            <!-- IDIOMA -->
            <label class="filter-chip filter-chip--dropdown">
                <span class="filter-chip__label">Idioma</span>
                <input
                    type="text"
                    name="language"
                    class="filter-chip__input"
                    list="languageOptions"
                    placeholder="Todos"
                    value="<?= htmlspecialchars($selectedLanguage) ?>"
                >
                <datalist id="languageOptions">
                    <option value="Español">
                    <option value="Inglés">
                    <option value="Francés">
                    <option value="Portugués">
                    <option value="Alemán">
                    <option value="Italiano">
                </datalist>
            </label>

            <!-- PÁGINAS: Max - Min -->
            <div class="filter-chip filter-chip--pages">
                <span class="filter-chip__label">Paginas</span>
                <div class="page-range">
                    <input
                        type="number"
                        name="pages_max"
                        class="page-range__input"
                        placeholder="Max"
                        min="1"
                        value="<?= htmlspecialchars($pagesMax) ?>"
                    >
                    <span class="page-range__dash">-</span>
                    <input
                        type="number"
                        name="pages_min"
                        class="page-range__input"
                        placeholder="Min"
                        min="1"
                        value="<?= htmlspecialchars($pagesMin) ?>"
                    >
                </div>
            </div>

        </div>

        <!-- Fila secundaria: solo Limpiar -->
        <div class="filters__row filters__row--secondary">
            <div class="filters__right filters__right--single">
                <button
                    class="filter-link"
                    type="button"
                    onclick="window.location='?';">
                    Limpiar
                </button>
            </div>
        </div>
    </div>
</form>
