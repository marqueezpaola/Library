<?php
// C:\xampp\htdocs\library\frontend\public\view\catalog\book_card.php

$id        = (int)$book['id'];
$title     = (string)$book['title'];
$author    = (string)($book['author'] ?? '');
$year      = (string)($book['year'] ?? '');
$ageRating = (string)($book['age_rating'] ?? '');
$coverUrl  = $book['cover_url'] ?? '/library/frontend/public/assets/img/placeholder-cover.png';
?>

<!-- ========================= -->
<!--   RUTAS QUE TÚ PEDISTE    -->
<!-- ========================= -->

<!-- CSS del card (TU RUTA EXACTA) -->
<link rel="stylesheet" href="/library/frontend/public/assets/css/catalog/book_card.css">

<!-- JS del card (TU RUTA EXACTA) -->
<script src="/library/frontend/public/assets/js/catalog/book_card.js" defer></script>


<!-- TARJETA -->
<article class="book-card" data-book-id="<?= $id ?>">

    <!-- IMAGEN -->
    <div class="book-card__media">
        <img
            src="<?= htmlspecialchars($coverUrl) ?>"
            alt="<?= htmlspecialchars($title) ?>"
            class="book-card__img">
    </div>

    <!-- TEXTO (ALINEADO A LA IZQUIERDA, PERO CON ESPACIO IGUAL A LOS LADOS) -->
    <div class="book-card__body">

        <h2 class="book-card__title">
            <?= htmlspecialchars($title) ?>
        </h2>

        <p class="book-card__author">
            <?= htmlspecialchars($author) ?>
        </p>

        <p class="book-card__meta">
            <?php if ($year !== ''): ?>
                <?= htmlspecialchars($year) ?>
            <?php endif; ?>
            <?php if ($year !== '' && $ageRating !== ''): ?>
                ·
            <?php endif; ?>
            <?php if ($ageRating !== ''): ?>
                <?= htmlspecialchars($ageRating) ?>
            <?php endif; ?>
        </p>

    </div>

    <!-- BOTÓN DETALLE (CENTRADO + COLOR #4e5871) -->
    <div class="book-card__actions">
        <button
            type="button"
            class="btn detail-btn"
            data-book-detail
            data-book-id="<?= $id ?>">
            Detalle
        </button>
    </div>

</article>
