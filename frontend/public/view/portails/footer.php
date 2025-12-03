<?php
// frontend/app/views/partials/footer.php
$year = date('Y');
?>

<!-- Bootstrap CSS (si ya lo cargas en otra parte, puedes borrar estas 2 líneas) -->
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
      rel="stylesheet">

<style>
  footer.biblioteca-footer {
    margin-top: 3rem;
    background: #f3f4f6;
    border-top: 1px solid #e5e7eb;
    font-family: 'Roboto', sans-serif;
  }
</style>

<footer class="biblioteca-footer">
  <div class="container py-3 text-center small text-muted">
    
    <div class="mb-1">
      © <?= $year; ?> Biblioteca Escolar "Roberto Echazú" ·
      Unidad Educativa Hno. Felipe Palazón
    </div>

    <div class="d-flex justify-content-center flex-wrap gap-3">
      <a href="/ayuda" class="link-primary text-decoration-none">
        Ayuda
      </a>
      <a href="/privacidad" class="link-primary text-decoration-none">
        Privacidad y uso responsable
      </a>
      <a href="/contacto" class="link-primary text-decoration-none">
        Contacto
      </a>
    </div>

  </div>
</footer>

<!-- Bootstrap JS (opcional para el footer, pero lo dejo aquí por si lo necesitas) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
