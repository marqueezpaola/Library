// navbar_admin.js
document.addEventListener("DOMContentLoaded", () => {

    /* ==========================
       ANIMACIÓN CAMPANA
    ========================== */
    const bellBtn = document.getElementById("adminNavbarBell");

    if (bellBtn) {
        bellBtn.addEventListener("click", () => {
            bellBtn.classList.add("is-ringing");

            setTimeout(() => {
                bellBtn.classList.remove("is-ringing");
            }, 650);
        });
    }

    /* ==========================
       ANIMACIÓN DE FLECHA
       (solo animación visual,
        el dropdown se abre por CSS)
    ========================== */
    const userWrapper = document.querySelector(".admin-navbar-user-wrapper");
    const arrowIcon = document.querySelector(".admin-navbar-user-arrow");

    if (userWrapper && arrowIcon) {
        userWrapper.addEventListener("mouseenter", () => {
            arrowIcon.classList.add("arrow-open");
        });

        userWrapper.addEventListener("mouseleave", () => {
            arrowIcon.classList.remove("arrow-open");
        });
    }
});
