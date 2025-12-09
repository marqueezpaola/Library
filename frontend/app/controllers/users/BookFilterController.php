<?php
// frontend/app/controllers/users/BookFilterController.php

require_once __DIR__ . '/../../helpers/ApiClient.php';

class BookFilterController
{
    public function index(): void
    {
        // Endpoints de la API
        $endpoints = require __DIR__ . '/../../../config/api_endpoints.php';

        // -------------------------------
        // Parámetros de búsqueda/paginación
        // -------------------------------
        $page    = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $perPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 24;
        $search  = isset($_GET['q']) ? trim($_GET['q']) : '';

        // -------------------------------
        // Filtros específicos del panel
        // (coinciden con los name="" de book_filters.php)
        // -------------------------------
        $genre        = isset($_GET['genre'])        ? trim($_GET['genre'])        : '';
        $availability = isset($_GET['availability']) ? trim($_GET['availability']) : '';
        $nationality  = isset($_GET['nationality'])  ? trim($_GET['nationality'])  : '';
        $language     = isset($_GET['language'])     ? trim($_GET['language'])     : '';
        $pagesMin     = isset($_GET['pages_min'])    ? (int)$_GET['pages_min']     : 0;
        $pagesMax     = isset($_GET['pages_max'])    ? (int)$_GET['pages_max']     : 0;

        // Orden (por si en el futuro quieres ordenar por título, año, etc.)
        $order = isset($_GET['order']) ? trim($_GET['order']) : 'title_asc';

        // -------------------------------
        // Construir query para el backend
        // -------------------------------
        $query = [
            'page'     => $page,
            'per_page' => $perPage,
            'order'    => $order,
        ];

        if ($search !== '') {
            $query['q'] = $search;
        }
        if ($genre !== '') {
            $query['genre'] = $genre;
        }
        if ($availability !== '') {
            $query['availability'] = $availability;
        }
        if ($nationality !== '') {
            $query['nationality'] = $nationality;
        }
        if ($language !== '') {
            $query['language'] = $language;
        }
        if ($pagesMin > 0) {
            $query['pages_min'] = $pagesMin;
        }
        if ($pagesMax > 0) {
            $query['pages_max'] = $pagesMax;
        }

        // -------------------------------
        // Llamar a la API del catálogo
        // -------------------------------
        $response = ApiClient::getJson($endpoints['catalog_list'], $query);

        $books = $response['data'] ?? [];
        $meta  = $response['meta'] ?? [
            'total'     => 0,
            'page'      => $page,
            'per_page'  => $perPage,
            'found'     => count($books),
            'search'    => $search,
        ];
        $error = $response['error'] ?? null;

        $pageTitle = 'Catálogo de Libros';

        // -------------------------------
        // Render de la vista principal
        // (esta vista incluye book_filters.php y el grid)
        // -------------------------------
        require __DIR__ . '/../../../public/pages/users/catalogo.php';
    }
}
