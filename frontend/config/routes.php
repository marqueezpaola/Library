<?php

return [
    // Catálogo público
    '/catalogo' => [
        'controller' => 'CatalogController',
        'action'     => 'index',
        'middleware' => [],  // sin Auth
    ],

    '/libro' => [
        'controller' => 'BookDetailController',
        'action'     => 'show',
        'middleware' => [],  // sin Auth
    ],
];
