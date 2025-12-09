// C:\xampp\htdocs\library\frontend\public\assets\js\catalog\book_filters.js

document.addEventListener('DOMContentLoaded', function () {
    var toggleBtn    = document.querySelector('[data-filters-toggle]');
    var filtersPanel = document.getElementById('catalogFilters');
    var clearBtn     = document.querySelector('[data-filters-clear]');
    var STORAGE_KEY  = 'catalogFiltersIsOpen';

    if (!toggleBtn || !filtersPanel) return;

    // Guardamos la transición actual (por si hay en el CSS)
    var prevTransition = filtersPanel.style.transition;
    // Desactivamos transición para fijar el estado inicial sin parpadeo
    filtersPanel.style.transition = 'none';

    function setOpenState(isOpen, options) {
        options = options || {};
        var save = options.save !== false; // por defecto guarda

        if (isOpen) {
            filtersPanel.classList.add('is-open');
            filtersPanel.classList.remove('is-collapsed');
            toggleBtn.setAttribute('aria-expanded', 'true');
        } else {
            filtersPanel.classList.remove('is-open');
            filtersPanel.classList.add('is-collapsed');
            toggleBtn.setAttribute('aria-expanded', 'false');
        }

        if (save) {
            try {
                sessionStorage.setItem(STORAGE_KEY, isOpen ? '1' : '0');
            } catch (e) {
                // ignorar errores de storage
            }
        }
    }

    function openFilters(opts) {
        setOpenState(true, opts);
    }

    function closeFilters(opts) {
        setOpenState(false, opts);
    }

    // --- ESTADO INICIAL ---
    var navType = 'navigate';
    try {
        var entries = performance.getEntriesByType && performance.getEntriesByType('navigation');
        if (entries && entries[0] && entries[0].type) {
            navType = entries[0].type; // "navigate", "reload", "back_forward"
        }
    } catch (e) {
        navType = 'navigate';
    }

    if (navType === 'reload') {
        // Ctrl+R / recarga → siempre empezar CERRADO
        closeFilters({ save: true });
    } else {
        // Navegación normal → restaurar el estado guardado (si existe)
        var saved = null;
        try {
            saved = sessionStorage.getItem(STORAGE_KEY);
        } catch (e) {
            saved = null;
        }

        if (saved === '1') {
            openFilters({ save: false });
        } else {
            closeFilters({ save: false });
        }
    }

    // Restauramos la transición en el siguiente frame
    requestAnimationFrame(function () {
        filtersPanel.style.transition = prevTransition;
    });

    function toggleFilters() {
        var isOpen = filtersPanel.classList.contains('is-open');
        setOpenState(!isOpen);
    }

    // Solo se abren / cierran con el botón del icono de filtro
    toggleBtn.addEventListener('click', toggleFilters);

    // Botón "Limpiar":
    // No tocamos el estado abierto/cerrado.
    // Si el formulario hace submit y recarga, navType="navigate"
    // y se restaurará el estado desde sessionStorage.
    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            // Aquí NO cambiamos nada del panel.
            // Solo se encargará el backend / form de limpiar resultados.
        });
    }
});
