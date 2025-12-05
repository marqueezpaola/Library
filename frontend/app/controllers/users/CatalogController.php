<?php
// frontend/app/controllers/users/CatalogController.php

require_once __DIR__ . '/../../helpers/ApiClient.php';

class CatalogController
{
    public function index(): void
    {
        $endpoints = require __DIR__ . '/../../../config/api_endpoints.php';

        // Leer parámetros de búsqueda/paginación del query string
        $page     = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $perPage  = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 24;
        $search   = isset($_GET['q']) ? trim($_GET['q']) : '';

        $query = [
            'page'     => $page,
            'per_page' => $perPage,
        ];
        if ($search !== '') {
            $query['q'] = $search;
        }

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
        require __DIR__ . '/../../../pages/users/catalogo.php';
    }
}
