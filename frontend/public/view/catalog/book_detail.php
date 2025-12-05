<?php
// public/view/catalog/book_detail.php

// Por ahora, como todavía no hay login
$isLoggedIn = false;

?>

<div id="book-detail-overlay" class="bd-overlay" hidden>
    <div class="bd-backdrop" data-bd-close></div>

    <div class="bd-modal" role="dialog" aria-modal="true">

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
                <img id="bd-cover-img" src="" alt="" loading="lazy">
            </div>
            <div class="bd-info">

                <!--  PANEL DERECHO -->
                <h2 id="bd-title-inside" class="bd-title-inside"></h2>

                <dl class="bd-meta">
                    <div>
                        <dt>Autor(a)</dt>
                        <dd id="bd-author"></dd>
                    </div>
                    <div>
                        <dt>Año de edición</dt>
                        <dd id="bd-year"></dd>
                    </div>
                    <div>
                        <dt>Editorial</dt>
                        <dd id="bd-publisher"></dd>
                    </div>
                    <div>
                        <dt>ISBN</dt>
                        <dd id="bd-isbn"></dd>
                    </div>
                    <div>
                        <dt>Ubicación en estante</dt>
                        <dd id="bd-shelf"></dd>
                    </div>
                    <div>
                        <dt>Cantidad en stock</dt>
                        <dd id="bd-stock"></dd>
                    </div>
                </dl>

                <section class="bd-synopsis">
                    <h3>Sinopsis</h3>
                    <p id="bd-synopsis"></p>
                </section>
            </div>
        </div>

        <!--  SOLO SI ESTÁ LOGUEADO -->
        <footer class="bd-footer">
            <?php if ($isLoggedIn): ?>
                <button type="button" class="btn btn--primary" id="btn-reservar">
                    Reservar
                </button>
            <?php endif; ?>
        </footer>

    </div>
</div>
