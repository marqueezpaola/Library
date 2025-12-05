<?php
// C:\xampp\htdocs\library\frontend\public\view\catalog\book_filters.php
?>
<div class="catalog__search">
    <form class="searchbar" action="" method="get">
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

        <button class="searchbar__addon" type="button" aria-label="Abrir filtros">
            <svg viewBox="0 0 24 24" class="i-20">
                <path d="M3 5a1 1 0 0 1 1-1h16a1 1 0 0 1 .8 1.6l-5.8 7.73V20a1 1 0 0 1-1.45.9l-4-2A1 1 0 0 1 9 18v-5.67L3.2 5.6A1 1 0 0 1 3 5z"/>
            </svg>
        </button>

        <button class="btn btn--primary searchbar__submit" type="submit">
            Buscar
        </button>
    </form>
</div>

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
            <select class="select-inline__control" name="per_page"
                    onchange="location.search='?per_page='+this.value">
                <option value="24" <?= $perPage == 24 ? 'selected' : '' ?>>24</option>
                <option value="48" <?= $perPage == 48 ? 'selected' : '' ?>>48</option>
                <option value="96" <?= $perPage == 96 ? 'selected' : '' ?>>96</option>
            </select>
        </label>
    </div>
</div>
