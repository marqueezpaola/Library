// assets/js/catalogo.js

document.addEventListener('DOMContentLoaded', function () {
  // -------- Navbar responsive (menú hamburguesa) --------
  // HTML esperado:
  // <button class="navbar__toggle" type="button" data-nav-toggle aria-label="Abrir menú">
  //   <svg class="navbar__toggle-icon" ...>...</svg>
  // </button>
  // <nav class="navbar__menu" data-nav-menu> ... </nav>

  const navToggle = document.querySelector('[data-nav-toggle]');
  const navMenu   = document.querySelector('[data-nav-menu]');
  const mqDesktop = window.matchMedia('(min-width: 769px)'); // mismo corte que el CSS

  // Si no existe la navbar, no hacemos nada
  if (!navToggle || !navMenu) return;

  function closeMenu() {
    navMenu.classList.remove('is-open');
    navToggle.setAttribute('aria-expanded', 'false');
  }

  function openMenu() {
    navMenu.classList.add('is-open');
    navToggle.setAttribute('aria-expanded', 'true');
  }

  function toggleMenu() {
    const isOpen = navMenu.classList.toggle('is-open');
    navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  }

  // Abrir / cerrar al pulsar el icono de las 3 rayitas
  navToggle.addEventListener('click', function (ev) {
    ev.stopPropagation(); // para que no lo cierre el listener global
    toggleMenu();
  });

  // Cerrar si se hace clic fuera del menú
  document.addEventListener('click', function (ev) {
    if (!navMenu.classList.contains('is-open')) return;

    const clickInsideMenu = navMenu.contains(ev.target);
    const clickOnToggle   = navToggle.contains(ev.target);

    if (!clickInsideMenu && !clickOnToggle) {
      closeMenu();
    }
  });

  // Cerrar el menú si se hace click dentro en algún enlace
  navMenu.addEventListener('click', function (ev) {
    const link = ev.target.closest('a');
    if (link) {
      closeMenu();
    }
  });

  // Cerrar con la tecla ESC
  document.addEventListener('keydown', function (ev) {
    if (ev.key === 'Escape' || ev.key === 'Esc') {
      if (navMenu.classList.contains('is-open')) {
        closeMenu();
      }
    }
  });

  // Si se vuelve a escritorio, cerramos el menú móvil
  function handleDesktopChange(e) {
    if (e.matches) {
      closeMenu();
    }
  }

  if (typeof mqDesktop.addEventListener === 'function') {
    mqDesktop.addEventListener('change', handleDesktopChange);
  } else if (typeof mqDesktop.addListener === 'function') {
    // soporte navegadores viejos
    mqDesktop.addListener(handleDesktopChange);
  }
});
