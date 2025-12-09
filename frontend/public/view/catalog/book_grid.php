<?php
// C:\xampp\htdocs\library\frontend\public\view\catalog\book_grid.php
?>

<!-- CSS específico del grid -->
<link rel="stylesheet" href="/library/frontend/public/assets/css/catalog/book_grid.css">

<section class="catalog">

    <h1 class="catalog-main-title">Libros Disponibles</h1>

    <?php if (empty($books)): ?>
        <div class="catalog__empty">
            No se encontraron resultados.
        </div>
    <?php else: ?>
        <div class="catalog__grid">
            <?php foreach ($books as $book): ?>
                <?php include __DIR__ . '/book_card.php'; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</section>

<!-- JS opcional del grid (solo animación / efectos suaves) -->
<script src="/library/frontend/public/assets/js/catalog/book_grid.js" defer></script>
