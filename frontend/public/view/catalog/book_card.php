<?php
// C:\xampp\htdocs\library\frontend\public\view\catalog\book_card.php

$id        = (int)$book['id'];
$title     = (string)$book['title'];
$author    = (string)($book['author'] ?? '');
$year      = (string)($book['year'] ?? '');
$ageRating = (string)($book['age_rating'] ?? '');
$coverUrl  = $book['cover_url'] ?? '/library/frontend/public/assets/img/placeholder-cover.png';
?>
<article class="book-card" data-book-id="<?= $id ?>">
    <div class="book-card__media">
        <img
            src="<?= htmlspecialchars($coverUrl) ?>"
            alt="<?= htmlspecialchars($title) ?>"
            class="book-card__img">
    </div>

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

    <div class="book-card__actions">
        <!-- Botón que abre el modal-->
<button
    type="button"
    class="btn btn--ghost"
    data-book-detail
    data-book-id="<?= $id ?>">
    Detalle
</button>

    </div>
</article>
