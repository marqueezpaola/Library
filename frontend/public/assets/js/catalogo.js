// assets/js/catalogo.js

document.addEventListener('DOMContentLoaded', function () {

    // NAVBAR
  const navToggle = document.querySelector('[data-nav-toggle]');
  const navMenu   = document.querySelector('[data-nav-menu]');
  const mqDesktop = window.matchMedia('(min-width: 769px)');

  if (navToggle && navMenu) {
    function closeMenu() {
      navMenu.classList.remove('is-open');
      navToggle.setAttribute('aria-expanded', 'false');
    }

    function toggleMenu() {
      const isOpen = navMenu.classList.toggle('is-open');
      navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    }

    navToggle.addEventListener('click', function (ev) {
      ev.stopPropagation();
      toggleMenu();
    });

    document.addEventListener('click', function (ev) {
      if (!navMenu.classList.contains('is-open')) return;
      const clickInsideMenu = navMenu.contains(ev.target);
      const clickOnToggle   = navToggle.contains(ev.target);
      if (!clickInsideMenu && !clickOnToggle) {
        closeMenu();
      }
    });

    navMenu.addEventListener('click', function (ev) {
      const link = ev.target.closest('a');
      if (link) {
        closeMenu();
      }
    });

    document.addEventListener('keydown', function (ev) {
      if (ev.key === 'Escape' || ev.key === 'Esc') {
        if (navMenu.classList.contains('is-open')) {
          closeMenu();
        }
      }
    });

    function handleDesktopChange(e) {
      if (e.matches) {
        closeMenu();
      }
    }

    if (typeof mqDesktop.addEventListener === 'function') {
      mqDesktop.addEventListener('change', handleDesktopChange);
    } else if (typeof mqDesktop.addListener === 'function') {
      mqDesktop.addListener(handleDesktopChange);
    }
  }


    // MODAL DE DETALLE DE LIBRO

  const overlay = document.getElementById('book-detail-overlay');
  if (!overlay) {
    console.error('No se encontró #book-detail-overlay en el DOM');
    return;
  }

  const backdrop  = overlay.querySelector('.bd-backdrop');
  const closeBtns = overlay.querySelectorAll('[data-bd-close]');
  const imgCover = document.getElementById('bd-cover-img');
  const elTitle  = document.getElementById('bd-title-inside');
  const elAuthor = document.getElementById('bd-author');
  const elYear   = document.getElementById('bd-year');
  const elPub    = document.getElementById('bd-publisher');
  const elIsbn   = document.getElementById('bd-isbn');
  const elShelf  = document.getElementById('bd-shelf');
  const elStock  = document.getElementById('bd-stock');
  const elSyn    = document.getElementById('bd-synopsis');

  function openOverlay() {
    overlay.hidden = false;
    document.body.style.overflow = 'hidden';
  }

  function closeOverlay() {
    overlay.hidden = true;
    document.body.style.overflow = '';
  }

  closeBtns.forEach(btn => {
    btn.addEventListener('click', closeOverlay);
  });

  if (backdrop) {
    backdrop.addEventListener('click', closeOverlay);
  }

  document.addEventListener('keydown', (ev) => {
    if ((ev.key === 'Escape' || ev.key === 'Esc') && !overlay.hidden) {
      closeOverlay();
    }
  });

  //click en botón Detalle
  document.addEventListener('click', async (ev) => {
    const btn = ev.target.closest('[data-book-detail]');
    if (!btn) return;

    const bookId = btn.getAttribute('data-book-id');
    if (!bookId) return;

    // Abrimos el modal inmediatamente
    imgCover.src = '/library/frontend/public/assets/img/placeholder-cover.png';
    imgCover.alt = '';
    elTitle.textContent  = 'Cargando…';
    elAuthor.textContent = '';
    elYear.textContent   = '';
    elPub.textContent    = '';
    elIsbn.textContent   = '';
    elShelf.textContent  = '';
    elStock.textContent  = '';
    elSyn.textContent    = '';

    openOverlay();

    try {
      const res = await fetch(
        `/library/backend/api/catalog/book_detail.php?id=${encodeURIComponent(bookId)}`
      );

      if (!res.ok) {
        console.error('Error HTTP', res.status);
        elTitle.textContent = 'No se pudo cargar el detalle';
        return;
      }

      const json = await res.json();
      const data = json.data || {};

      imgCover.src = data.cover_url || '/library/frontend/public/assets/img/placeholder-cover.png';
      imgCover.alt = data.cover_alt || data.title || '';

      elTitle.textContent  = data.title || '';
      elAuthor.textContent = data.author || '';
      elYear.textContent   = data.year || '';
      elPub.textContent    = data.publisher || '';
      elIsbn.textContent   = data.isbn || '';
      elShelf.textContent  = data.shelf_locations || '';
      elStock.textContent  = (data.stock_total != null ? data.stock_total : '');
      elSyn.textContent    = data.synopsis || '';
    } catch (e) {
      console.error('Error al cargar detalle', e);
      elTitle.textContent = 'Error al cargar el detalle';
    }
  });

});
