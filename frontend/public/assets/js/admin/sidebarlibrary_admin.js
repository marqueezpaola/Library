// sidebarlibrary_admin.js
document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const sidebarWrapper = document.getElementById("sidebarWrapper");
    const toggleBtn = document.getElementById("toggleSidebar");
    const sidebarBrand = document.getElementById("sidebarBrand");

    if (!sidebarWrapper) return;

    const toggleSidebar = () => {
        sidebarWrapper.classList.toggle("collapsed");
        body.classList.toggle("sidebar-collapsed");
    };

    // Botón "Contraer" (abajo)
    if (toggleBtn) {
        toggleBtn.addEventListener("click", () => {
            toggleSidebar();

            toggleBtn.classList.add("is-clicked");
            setTimeout(() => {
                toggleBtn.classList.remove("is-clicked");
            }, 180);
        });
    }

    // Clic en el logo para expandir si está contraído (opcional, cómodo)
    if (sidebarBrand) {
        sidebarBrand.addEventListener("click", () => {
            if (sidebarWrapper.classList.contains("collapsed")) {
                toggleSidebar();
            }
        });
    }
});
