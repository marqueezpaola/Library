<?php
// backend/api/catalog/book_detail.php
// ESTO ES EL DETALLE DE LOS LIBROS

require_once __DIR__ . '/../../db/sql_conection.php';

$db = get_db();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    respond_json(['error' => 'INVALID_ID'], 400);
}

$sql = "
    SELECT
        l.id,
        l.titulo,
        l.subtitulo,
        l.autor,
        l.sinopsis,
        l.editorial,
        l.sello_editorial,
        l.anio_edicion,
        l.isbn,
        l.isbn13,
        l.nro_paginas,
        l.codigo_clasificacion,
        l.marbete_autor,
        l.procedencia,
        l.fecha_ingreso,
        l.estado_ingreso,
        l.estado_inventario,
        l.originalidad,
        l.nacionalidad_autor,
        l.presentacion,
        l.formato,
        l.edad_recomendada,
        l.nota,
        l.valoracion_promedio,
        l.creado_en,
        l.actualizado_en,
        p.drive_file_id AS portada_drive_id,
        p.url           AS portada_url,
        p.alt_text      AS portada_alt,
        COALESCE(COUNT(e.id), 0) AS stock_total,
        GROUP_CONCAT(DISTINCT e.ubicacion ORDER BY e.ubicacion SEPARATOR ', ') AS ubicaciones
    FROM b_libro l
    LEFT JOIN b_portada p
        ON p.libro_id = l.id
       AND p.es_principal = 1
    LEFT JOIN b_libro_ejemplar e
        ON e.libro_id = l.id
    WHERE l.id = ?
    GROUP BY
        l.id,
        l.titulo,
        l.subtitulo,
        l.autor,
        l.sinopsis,
        l.editorial,
        l.sello_editorial,
        l.anio_edicion,
        l.isbn,
        l.isbn13,
        l.nro_paginas,
        l.codigo_clasificacion,
        l.marbete_autor,
        l.procedencia,
        l.fecha_ingreso,
        l.estado_ingreso,
        l.estado_inventario,
        l.originalidad,
        l.nacionalidad_autor,
        l.presentacion,
        l.formato,
        l.edad_recomendada,
        l.nota,
        l.valoracion_promedio,
        l.creado_en,
        l.actualizado_en,
        p.drive_file_id,
        p.url,
        p.alt_text
";

$stmt = $db->prepare($sql);

if (!$stmt) {
    respond_json([
        'error'  => 'DB_QUERY_PREPARE_ERROR',
        'detail' => $db->error,
        'stage'  => 'book_detail',
    ], 500);
}

$stmt->bind_param('i', $id);
$stmt->execute();
$res  = $stmt->get_result();
$book = $res->fetch_assoc();
$stmt->close();

if (!$book) {
    respond_json(['error' => 'BOOK_NOT_FOUND'], 404);
}

// Construir la URL de la portada que sera por el id
$coverUrl = null;

$driveId = trim((string)($book['portada_drive_id'] ?? ''));
if ($driveId !== '') {
    $coverUrl = '/library/backend/api/catalog/book_cover.php?libro_id=' . (int)$book['id'];
} elseif (!empty($book['portada_url'])) {
    $coverUrl = $book['portada_url'];
}


$bookDetail = [
    'id'                 => (int)$book['id'],
    'title'              => $book['titulo'],
    'subtitle'           => $book['subtitulo'],
    'author'             => $book['autor'],
    'synopsis'           => $book['sinopsis'],
    'publisher'          => $book['editorial'],
    'imprint'            => $book['sello_editorial'],
    'year'               => $book['anio_edicion'],
    'isbn'               => $book['isbn'],
    'isbn13'             => $book['isbn13'],
    'pages'              => $book['nro_paginas'],
    'dewey_code'         => $book['codigo_clasificacion'],
    'author_cutter'      => $book['marbete_autor'],
    'provenance'         => $book['procedencia'],
    'entry_date'         => $book['fecha_ingreso'],
    'ingress_state'      => $book['estado_ingreso'],
    'inventory_state'    => $book['estado_inventario'],
    'originality'        => $book['originalidad'],
    'author_country'     => $book['nacionalidad_autor'],
    'presentation'       => $book['presentacion'],
    'format'             => $book['formato'],
    'age_rating'         => $book['edad_recomendada'],
    'note'               => $book['nota'],
    'rating_avg'         => $book['valoracion_promedio'],
    'created_at'         => $book['creado_en'],
    'updated_at'         => $book['actualizado_en'],
    'cover_url'          => $coverUrl,
    'cover_alt'          => $book['portada_alt'],
    'stock_total'        => (int)$book['stock_total'],
    'shelf_locations'    => $book['ubicaciones'],
    'genres'             => [],
    'topics'             => [],
];

respond_json([
    'data' => $bookDetail,
]);
