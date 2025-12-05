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
