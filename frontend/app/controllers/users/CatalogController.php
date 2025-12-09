<?php
// frontend/app/controllers/users/CatalogController.php

require_once __DIR__ . '/../../helpers/ApiClient.php';

class CatalogController
{
    public function index(): void
    {
        $endpoints = require __DIR__ . '/../../../config/api_endpoints.php';

        // -------------------------------
        // Parámetros de búsqueda/paginación
        // -------------------------------
        $page    = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $perPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 24;
        $search  = isset($_GET['q']) ? trim($_GET['q']) : '';

        // -------------------------------
        // Parámetros de filtro adicionales
        // -------------------------------
        $category = isset($_GET['category']) ? trim($_GET['category']) : '';
        $author   = isset($_GET['author'])   ? trim($_GET['author'])   : '';
        $status   = isset($_GET['status'])   ? trim($_GET['status'])   : '';
        $order    = isset($_GET['order'])    ? trim($_GET['order'])    : 'title_asc';

        // -------------------------------
        // Construir query para el backend
        // -------------------------------
        $query = [
            'page'     => $page,
            'per_page' => $perPage,
            'order'    => $order,   // enviamos siempre el orden
        ];

        if ($search !== '') {
            $query['q'] = $search;
        }
        if ($category !== '') {
            $query['category'] = $category;
        }
        if ($author !== '') {
            $query['author'] = $author;
        }
        if ($status !== '') {
            $query['status'] = $status;
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
            'found'     => 0,
            'search'    => $search,
        ];
        $error = $response['error'] ?? null;

        $pageTitle = 'Catálogo de Libros';

        // Render de la vista principal del catálogo
        require __DIR__ . '/../../../public/pages/users/catalogo.php';
    }
}
