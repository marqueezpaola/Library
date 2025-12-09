// login-ui.js
// Solo efectos visuales: mostrar/ocultar contraseña, pequeño "loading" en botones,
// y un toque de animación en el botón de Google. Sin llamadas al backend ni lógica de negocio.

document.addEventListener("DOMContentLoaded", function () {
    // Toggle mostrar/ocultar contraseña
    const toggleButtons = document.querySelectorAll("[data-toggle-password]");

    toggleButtons.forEach(function (btn) {
        btn.addEventListener("click", function () {
            const wrapper = btn.closest(".auth-input-wrapper");
            if (!wrapper) return;

            const input = wrapper.querySelector("[data-password-input]");
            if (!input) return;

            const currentType = input.getAttribute("type");
            const isPassword = currentType === "password";
            input.setAttribute("type", isPassword ? "text" : "password");

            // Pequeña animación visual
            btn.style.transform = "scale(1.1)";
            setTimeout(() => {
                btn.style.transform = "";
            }, 120);
        });
    });

    // Efecto "loading" visual en botones principales al hacer clic
    const mainButtons = document.querySelectorAll("[data-submit-main]");

    mainButtons.forEach(function (btn) {
        btn.addEventListener("click", function () {
            // Solo efecto visual: el backend/control real se implementará después.
            btn.classList.add("auth-button--loading");
            setTimeout(() => {
                btn.classList.remove("auth-button--loading");
            }, 1200); // efecto corto solo para demo visual
        });
    });

    // Animación suave al botón de Google al hacer hover mediante clase
    const googleButton = document.querySelector(".auth-button--google");
    if (googleButton) {
        googleButton.addEventListener("mouseenter", function () {
            googleButton.classList.add("auth-button--google--hovered");
        });

        googleButton.addEventListener("mouseleave", function () {
            googleButton.classList.remove("auth-button--google--hovered");
        });
    }

    // Clase de ayuda para dispositivos muy pequeños (opcional)
    function updateCompactMode() {
        const card = document.querySelector(".auth-card");
        if (!card) return;

        if (window.innerWidth < 360) {
            card.classList.add("auth-card--compact");
        } else {
            card.classList.remove("auth-card--compact");
        }
    }

    updateCompactMode();
    window.addEventListener("resize", updateCompactMode);
});
