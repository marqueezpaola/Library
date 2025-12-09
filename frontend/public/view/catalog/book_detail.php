<?php
// public/view/catalog/book_detail.php

// La lógica real de login / sesión está en otros archivos.
// Aquí solo nos aseguramos de que la variable exista.
$isLoggedIn = $isLoggedIn ?? false;

// $book viene desde BookDetailController::show()
$book = $book ?? [];

// Helpers simples (sin cosas raras)
function esc($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

// Mapear campos desde el JSON que devuelve backend/api/catalog/book_detail.php
$title        = isset($book['title'])   ? esc($book['title'])   : '';
$subtitle     = isset($book['subtitle']) ? esc($book['subtitle']) : '';
$author       = isset($book['author'])  ? esc($book['author'])  : '';
$isbn         = isset($book['isbn'])    ? esc($book['isbn'])    : '';
$synopsis     = isset($book['synopsis'])? esc($book['synopsis']): '';

$publisher    = isset($book['publisher']) ? esc($book['publisher']) : '';
$year         = isset($book['year'])      ? esc($book['year'])      : '';

$pages        = isset($book['pages'])        ? (int)$book['pages'] : '';  // Nº páginas
$country      = !empty($book['country'])
                    ? esc($book['country'])
                    : (!empty($book['author_country']) ? esc($book['author_country']) : '');
$format       = isset($book['format'])       ? esc($book['format'])       : '';
$shelf        = isset($book['shelf_locations']) ? esc($book['shelf_locations']) : '';
$stock        = isset($book['stock_total'])  ? (int)$book['stock_total']  : '';

// Idioma: la API aún NO envía 'language', así que esto quedará vacío.
$language     = isset($book['language']) ? esc($book['language']) : '';

// Portada
$coverUrl = !empty($book['cover_url'])
    ? (string)$book['cover_url']
    : '/library/frontend/public/assets/img/placeholder-cover.png';

$coverAlt = !empty($book['cover_alt'])
    ? (string)$book['cover_alt']
    : ($title !== '' ? 'Portada del libro "' . $title . '"' : 'Portada del libro');
?>

<!-- CSS y JS propios de este componente -->
<link rel="stylesheet" href="../../assets/css/catalog/book_detail.css">
<script src="../../assets/js/catalog/book_detail.js" defer></script>

<div id="book-detail-overlay" class="bd-overlay" hidden>
    <div class="bd-backdrop" data-bd-close></div>

    <div class="bd-modal" role="dialog" aria-modal="true" aria-labelledby="bd-title-inside">

        <!-- Header solo con botón cerrar -->
        <header class="bd-header">
            <button type="button"
                    class="bd-close"
                    data-bd-close
                    aria-label="Cerrar">✕</button>
        </header>

        <div class="bd-body">

            <!-- PORTADA -->
            <div class="bd-cover">
                <img
                    id="bd-cover-img"
                    src="<?= esc($coverUrl) ?>"
                    alt="<?= esc($coverAlt) ?>"
                    loading="lazy">
            </div>

            <!-- PANEL DERECHO -->
            <div class="bd-info">

                <section class="bd-main-info">
                    <h2 id="bd-title-inside" class="bd-title-inside">
                        <?= $title ?>
                    </h2>
                    <p id="bd-subtitle" class="bd-subtitle">
                        <?= $subtitle ?>
                    </p>

                    <div class="bd-author-row">
                        <span class="bd-label">Autor(a)</span>
                        <span id="bd-author" class="bd-value bd-value--author">
                            <?= $author ?>
                        </span>

                        <div class="bd-rating" id="bd-rating" aria-label="Valoración">
                            <!-- Puedes cambiar estas estrellas desde PHP o JS si quieres -->
                            <span class="bd-star">★</span>
                            <span class="bd-star">★</span>
                            <span class="bd-star">★</span>
                            <span class="bd-star">★</span>
                            <span class="bd-star">★</span>
                        </div>

                        <span class="bd-label bd-label--isbn">ISBN</span>
                        <span id="bd-isbn" class="bd-value bd-value--isbn">
                            <?= $isbn ?>
                        </span>
                    </div>
                </section>

                <section class="bd-synopsis">
                    <h3>Sinopsis</h3>
                    <p id="bd-synopsis">
                        <?= nl2br($synopsis) ?>
                    </p>
                </section>

                <hr class="bd-divider">

                <!-- Datos de ficha técnica en estilo de dos columnas -->
                <section class="bd-specs">
                    <dl class="bd-meta-grid">
                        <div>
                            <dt>Editorial</dt>
                            <dd id="bd-publisher"><?= $publisher ?></dd>
                        </div>
                        <div>
                            <dt>Año edición</dt>
                            <dd id="bd-year"><?= $year ?></dd>
                        </div>
                        <div>
                            <dt>Número de páginas</dt>
                            <dd id="bd-pages"><?= $pages ?></dd>
                        </div>
                        <div>
                            <dt>Idioma</dt>
                            <dd id="bd-language">
                                <?= $language /* ahora mismo la API no lo envía, quedará vacío */ ?>
                            </dd>
                        </div>
                        <div>
                            <dt>Nacionalidad</dt>
                            <dd id="bd-country"><?= $country ?></dd>
                        </div>
                        <div>
                            <dt>Formato</dt>
                            <dd id="bd-format"><?= $format ?></dd>
                        </div>
                        <div>
                            <dt>Ubicación en estante</dt>
                            <dd id="bd-shelf"><?= $shelf ?></dd>
                        </div>
                        <div>
                            <dt>Cantidad en stock</dt>
                            <dd id="bd-stock"><?= $stock ?></dd>
                        </div>
                    </dl>
                </section>

            </div>
        </div>

        <!-- SOLO SI ESTÁ LOGUEADO -->
        <footer class="bd-footer">
            <?php if ($isLoggedIn): ?>
                <button type="button" class="bd-btn-primary" id="btn-reservar">
                    Reservar
                </button>
            <?php endif; ?>
        </footer>

    </div>
</div>
