// public/assets/js/catalog/book_detail.js
// Solo maneja la animación / visibilidad del modal.
// La lógica de negocio la tienes en PHP u otros scripts.

document.addEventListener("DOMContentLoaded", () => {
    const overlay = document.getElementById("book-detail-overlay");
    if (!overlay) return;

    const closeTriggers = overlay.querySelectorAll("[data-bd-close]");

    function showOverlay() {
        // Si ya está visible, no hacemos nada
        if (!overlay.hasAttribute("hidden")) {
            overlay.classList.add("bd-overlay--visible");
            return;
        }

        overlay.removeAttribute("hidden");

        // La clase se añadirá también desde el MutationObserver,
        // pero la dejamos aquí por si llamas directamente a esta función
        requestAnimationFrame(() => {
            overlay.classList.add("bd-overlay--visible");
        });
    }

    function hideOverlay() {
        // quitamos la clase de animación
        overlay.classList.remove("bd-overlay--visible");

        // esperamos un poquito para que la animación de salida se vea
        setTimeout(() => {
            overlay.setAttribute("hidden", "hidden");
        }, 180);
    }

    // Observa cambios en el atributo "hidden" para mantener compatibilidad
    // con tu código anterior (el que solo quitaba/ponía hidden).
    const observer = new MutationObserver((mutations) => {
        for (const m of mutations) {
            if (m.attributeName === "hidden") {
                const isHidden = overlay.hasAttribute("hidden");

                if (!isHidden) {
                    // Algún código quitó el hidden (como antes),
                    // así que añadimos la clase para mostrar y animar.
                    requestAnimationFrame(() => {
                        overlay.classList.add("bd-overlay--visible");
                    });
                } else {
                    // Si le vuelven a poner hidden desde fuera,
                    // aseguramos que también se quite la clase.
                    overlay.classList.remove("bd-overlay--visible");
                }
            }
        }
    });

    observer.observe(overlay, {
        attributes: true,
        attributeFilter: ["hidden"]
    });

    // Cerrar con click en botón ✕ o en el backdrop
    closeTriggers.forEach((el) => {
        el.addEventListener("click", hideOverlay);
    });

    // Cerrar con ESC
    document.addEventListener("keydown", (ev) => {
        if (ev.key === "Escape") {
            hideOverlay();
        }
    });

    // Funciones públicas por si quieres usarlas en otro JS
    window.showBookDetailOverlay = showOverlay;
    window.hideBookDetailOverlay = hideOverlay;
});
