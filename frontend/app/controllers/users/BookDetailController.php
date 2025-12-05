<?php
// frontend/app/controllers/users/BookDetailController.php

require_once __DIR__ . '/../../helpers/ApiClient.php';

class BookDetailController
{
    public function show(): void
    {
        $endpoints = require __DIR__ . '/../../../config/api_endpoints.php';

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($id <= 0) {
            $error = 'ID inválido';
            $book  = null;
        } else {
            $response = ApiClient::getJson($endpoints['book_detail'], ['id' => $id]);
            $book     = $response['data'] ?? null;
            $error    = $response['error'] ?? null;
        }

        $pageTitle = $book ? $book['title'] : 'Detalle de libro';

        require __DIR__ . '/../../../public/pages/users/book_detail.php';
    }
}
