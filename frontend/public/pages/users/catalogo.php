<?php
// frontend/public/pages/users/catalogo.php

// 1) Llamamos al helper de la API y a los endpoints
require_once __DIR__ . '/../../../app/helpers/ApiClient.php';
$endpoints = require __DIR__ . '/../../../config/api_endpoints.php';

// 2) Parámetros de búsqueda / paginación desde la URL
$page    = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$perPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 24;
$search  = isset($_GET['q']) ? trim($_GET['q']) : '';

// Filtros adicionales (si tu formulario los usa)
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$author   = isset($_GET['author'])   ? trim($_GET['author'])   : '';
$status   = isset($_GET['status'])   ? trim($_GET['status'])   : '';
$order    = isset($_GET['order'])    ? trim($_GET['order'])    : 'title_asc';

// 3) Armamos el query que se enviará al backend
$query = [
    'page'     => $page,
    'per_page' => $perPage,
    'order'    => $order,
];

if ($search !== '') {
    $query['q'] = $search;
}
if ($category !== '') {
    $query['category'] = $category;
}
if ($author !== '') {
    $query['author'] = $author;
}
if ($status !== '') {
    $query['status'] = $status;
}

// 4) Llamamos a la API del catálogo
$response = ApiClient::getJson($endpoints['catalog_list'], $query);

// 5) Datos que vienen del backend
$books = $response['data'] ?? [];
$meta  = $response['meta'] ?? [
    'total'     => count($books),
    'page'      => $page,
    'per_page'  => $perPage,
    'found'     => count($books),
    'search'    => $search,
];
$error = $response['error'] ?? null;

// 6) Cálculos visuales (X–Y de Z resultados)
$total   = (int)($meta['total'] ?? 0);
$page    = (int)($meta['page'] ?? 1);
$perPage = (int)($meta['per_page'] ?? 24);
$found   = (int)($meta['found'] ?? count($books));
$search  = (string)($meta['search'] ?? '');

if ($total === 0) {
    $from = 0;
    $to   = 0;
} else {
    $from = ($page - 1) * $perPage + 1;
    $to   = $from + $found - 1;
}
?>

<!-- CSS general del catálogo -->
<link rel="stylesheet" href="../../assets/css/catalogo.css">

<!-- CSS específico del grid de libros -->
<link rel="stylesheet" href="/library/frontend/public/assets/css/catalog/book_grid.css">

<header>
    <?php include __DIR__ . '/../../view/portails/navbar.php'; ?>
</header>

<section class="catalog">

    <!-- Header -->
    <header class="catalog__header">
        <div class="catalog__title-wrap">
            <h1 class="catalog__title">Libros disponibles</h1>
            <p class="catalog__subtitle">Descubre y explora nuestra colección completa</p>
        </div>
        <div class="catalog__meta">
            <span class="catalog__meta-text">
                <?= $total ?> libros disponibles
            </span>
        </div>
    </header>

    <!-- Mostrar error técnico si falló el backend -->
    <?php if (!empty($error)): ?>
        <p style="color:red; padding: 0 1.5rem;">
            Error al cargar el catálogo (<?= htmlspecialchars($error) ?>).
        </p>
    <?php endif; ?>

    <?php
    // Barra de búsqueda + filtros
    include __DIR__ . '/../../view/catalog/book_filters.php';
    ?>

    <!-- Info de resultados -->
    <div class="catalog__resultinfo">
        Mostrando <?= $from ?>–<?= $to ?> de <?= $total ?> resultados
    </div>

    <?php
    // Grid de tarjetas
    include __DIR__ . '/../../view/catalog/book_grid.php';
    ?>

    <?php
    // Paginación
    $totalPages = $perPage > 0 ? (int)ceil($total / $perPage) : 1;
    ?>
    <nav class="catalog__pagination" aria-label="Paginación">
        <button class="page-btn" type="button"
                <?= $page <= 1 ? 'disabled' : '' ?>
                onclick="window.location='?page=<?= max(1, $page-1) ?>&per_page=<?= $perPage ?>&q=<?= urlencode($search) ?>'">
            ‹
        </button>

        <button class="page-btn is-active" type="button">
            <?= $page ?>
        </button>

        <button class="page-btn" type="button"
                <?= $page >= $totalPages ? 'disabled' : '' ?>
                onclick="window.location='?page=<?= min($totalPages, $page+1) ?>&per_page=<?= $perPage ?>&q=<?= urlencode($search) ?>'">
            ›
        </button>
    </nav>
</section>

<?php
// Modal de detalle de libro
include __DIR__ . '/../../view/catalog/book_detail.php';
?>

<!-- JS del panel de filtros -->
<script defer src="/library/frontend/public/assets/js/catalog/book_filters.js"></script>

<!-- JS del grid (solo animación / presentación) -->
<script defer src="/library/frontend/public/assets/js/catalog/book_grid.js"></script>

<!-- Tu JS general del catálogo -->
<script defer src="/library/frontend/public/assets/js/catalogo.js"></script>
