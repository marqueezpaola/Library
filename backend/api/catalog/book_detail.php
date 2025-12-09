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

    // Títulos / autoría
    'title'              => $book['titulo'],
    'subtitle'           => $book['subtitulo'],
    'author'             => $book['autor'],

    // Texto largo
    'synopsis'           => $book['sinopsis'],

    // Editorial
    'publisher'          => $book['editorial'],
    'imprint'            => $book['sello_editorial'],

    // Año
    'year'               => $book['anio_edicion'],

    // Identificadores
    'isbn'               => $book['isbn'],
    'isbn13'             => $book['isbn13'],

    // Páginas: clave nueva y alias con el nombre original de la columna
    'pages'              => $book['nro_paginas'],   // para el frontend nuevo
    'nro_paginas'        => $book['nro_paginas'],   // por si algo del frontend viejo usa este nombre

    // Clasificación
    'dewey_code'         => $book['codigo_clasificacion'],
    'author_cutter'      => $book['marbete_autor'],

    // Procedencia
    'provenance'         => $book['procedencia'],
    'entry_date'         => $book['fecha_ingreso'],
    'ingress_state'      => $book['estado_ingreso'],
    'inventory_state'    => $book['estado_inventario'],
    'originality'        => $book['originalidad'],

    // Nacionalidad: dos claves para que cualquier cosa la pueda usar
    'author_country'     => $book['nacionalidad_autor'],
    'country'            => $book['nacionalidad_autor'],

    // Presentación / formato
    'presentation'       => $book['presentacion'],

    // Formato: clave nueva y alias
    'format'             => $book['formato'],       // para el frontend nuevo
    'formato'            => $book['formato'],       // alias por compatibilidad

    // Edad recomendada
    'age_rating'         => $book['edad_recomendada'],

    // Otros
    'note'               => $book['nota'],
    'rating_avg'         => $book['valoracion_promedio'],
    'created_at'         => $book['creado_en'],
    'updated_at'         => $book['actualizado_en'],

    // Portada
    'cover_url'          => $coverUrl,
    'cover_alt'          => $book['portada_alt'],

    // Stock
    'stock_total'        => (int)$book['stock_total'],
    'shelf_locations'    => $book['ubicaciones'],

    // De momento no hay idioma en la tabla, así que no podemos mandar 'language' sin romper el SELECT
    // 'language'        => ...,

    // Listas vacías por ahora
    'genres'             => [],
    'topics'             => [],
];

respond_json([
    'data' => $bookDetail,
]);
