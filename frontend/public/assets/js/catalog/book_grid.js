// C:\xampp\htdocs\library\frontend\public\assets\js\catalog\book_grid.js

document.addEventListener("DOMContentLoaded", () => {
    const grid = document.querySelector(".catalog__grid");
    if (!grid) return;

    // Animación muy suave al cargar el grid
    grid.style.opacity = "0";
    grid.style.transition = "opacity 180ms ease-out";

    requestAnimationFrame(() => {
        grid.style.opacity = "1";
    });
});
