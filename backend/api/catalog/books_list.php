<?php
// backend/api/catalog/book_list.php
// LISTADO DE LIBROS (catálogo) con búsqueda + filtros

require_once __DIR__ . '/../../db/sql_conection.php';

$db = get_db();

// ---------------------------
// Parámetros base
// ---------------------------
$page     = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$perPage  = isset($_GET['per_page']) ? max(1, min(100, (int)$_GET['per_page'])) : 24;
$search   = isset($_GET['q']) ? trim($_GET['q']) : '';

// Filtro por autor (campo "author")
$author   = isset($_GET['author']) ? trim($_GET['author']) : '';

// Filtros del panel avanzado
$genre        = isset($_GET['genre'])        ? trim($_GET['genre'])        : '';
$availability = isset($_GET['availability']) ? trim($_GET['availability']) : '';
$nationality  = isset($_GET['nationality'])  ? trim($_GET['nationality'])  : '';
$language     = isset($_GET['language'])     ? trim($_GET['language'])     : '';
$pagesMin     = isset($_GET['pages_min'])    ? (int)$_GET['pages_min']     : 0;
$pagesMax     = isset($_GET['pages_max'])    ? (int)$_GET['pages_max']     : 0;

// Orden (opcional)
$order = isset($_GET['order']) ? trim($_GET['order']) : 'title_asc';

$offset = ($page - 1) * $perPage;

// condición base: solo libros activos
$where  = "l.ESTADO_SQL = 1";
$params = [];
$types  = '';

// ====================================================
// 1) BÚSQUEDA GENERAL (título, autor, isbn) -> campo "q"
// ====================================================
if ($search !== '') {
    $where .= " AND (l.titulo LIKE ? OR l.autor LIKE ? OR l.isbn LIKE ?)";
    $like = '%' . $search . '%';
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $types   .= 'sss';
}

// ====================================================
// 2) FILTRO POR AUTOR (campo "author"), prefijo
// ====================================================
if ($author !== '') {
    $where     .= " AND l.autor LIKE ?";
    $params[]   = $author . '%';
    $types     .= 's';
}

// ====================================================
// 3) FILTRO POR GÉNERO
//    ⚠ No puedo confirmar el nombre real de la columna.
//    Aquí suponemos que es l.genero. Si tu columna tiene
//    otro nombre, cámbialo.
// ====================================================
if ($genre !== '') {
    $where     .= " AND l.genero = ?"; // <-- ajusta si tu columna se llama distinto
    $params[]   = $genre;
    $types     .= 's';
}

// ====================================================
// 4) FILTRO POR DISPONIBILIDAD
//    En tu detalle usas l.estado_inventario, así que lo
//    más lógico es filtrar por ese campo.
//    Ej: availability = 'DISPONIBLE', 'NO_DISPONIBLE', etc.
// ====================================================
if ($availability !== '') {
    $where     .= " AND l.estado_inventario = ?";
    $params[]   = $availability;
    $types     .= 's';
}

// ====================================================
// 5) FILTRO POR NACIONALIDAD DEL AUTOR
//    Esta columna SÍ la veo en tu book_detail: l.nacionalidad_autor
// ====================================================
if ($nationality !== '') {
    $where     .= " AND l.nacionalidad_autor = ?";
    $params[]   = $nationality;
    $types     .= 's';
}

// ====================================================
// 6) FILTRO POR IDIOMA
//    ⚠ No puedo confirmar el nombre real de la columna.
//    Aquí supongo l.idioma. Cambia si tu columna se llama
//    de otra forma.
// ====================================================
if ($language !== '') {
    $where     .= " AND l.idioma = ?"; // <-- ajusta si tu columna se llama distinto
    $params[]   = $language;
    $types     .= 's';
}

// ====================================================
// 7) FILTRO POR RANGO DE PÁGINAS (nro_paginas)
//    Esta columna SÍ aparece en book_detail.
// ====================================================
if ($pagesMin > 0) {
    $where     .= " AND l.nro_paginas >= ?";
    $params[]   = $pagesMin;
    $types     .= 'i';
}

if ($pagesMax > 0) {
    $where     .= " AND l.nro_paginas <= ?";
    $params[]   = $pagesMax;
    $types     .= 'i';
}

// ====================================================
// COUNT
// ====================================================
$countSql = "SELECT COUNT(*) AS total FROM b_libro l WHERE $where";
$countStmt = $db->prepare($countSql);
if ($types !== '') {
    $countStmt->bind_param($types, ...$params);
}
$countStmt->execute();
$countResult = $countStmt->get_result()->fetch_assoc();
$totalBooks  = (int)($countResult['total'] ?? 0);
$countStmt->close();

// ====================================================
// LISTA DE LIBROS
// ====================================================

// Orden dinámico según "order"
$orderBy = "l.titulo ASC";
switch ($order) {
    case 'title_desc':
        $orderBy = "l.titulo DESC";
        break;
    case 'year_asc':
        $orderBy = "l.anio_edicion ASC";
        break;
    case 'year_desc':
        $orderBy = "l.anio_edicion DESC";
        break;
    default:
        $orderBy = "l.titulo ASC";
        break;
}

$listSql = "
    SELECT
        l.id,
        l.titulo,
        l.autor,
        l.anio_edicion,
        l.nacionalidad_autor,
        l.edad_recomendada,
        l.sinopsis,
        p.drive_file_id AS portada_drive_id,
        COALESCE(COUNT(e.id), 0) AS stock_total
    FROM b_libro l
    LEFT JOIN b_portada p
        ON p.libro_id = l.id
       AND p.es_principal = 1
    LEFT JOIN b_libro_ejemplar e
        ON e.libro_id = l.id
    WHERE $where
    GROUP BY
        l.id,
        l.titulo,
        l.autor,
        l.anio_edicion,
        l.nacionalidad_autor,
        l.edad_recomendada,
        l.sinopsis,
        p.drive_file_id
    ORDER BY $orderBy
    LIMIT ? OFFSET ?
";

$listStmt = $db->prepare($listSql);

// mismos filtros + paginación
$paramsWithLimit   = $params;
$paramsWithLimit[] = $perPage;
$paramsWithLimit[] = $offset;
$typesWithLimit    = $types . 'ii';

$listStmt->bind_param($typesWithLimit, ...$paramsWithLimit);
$listStmt->execute();
$result = $listStmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {

    $driveId  = trim((string)($row['portada_drive_id'] ?? ''));
    $coverUrl = null;

    if ($driveId !== '') {
        $coverUrl = '/library/backend/api/catalog/book_cover.php?libro_id=' . (int)$row['id'];
    }

    $items[] = [
        'id'          => (int)$row['id'],
        'title'       => $row['titulo'],
        'author'      => $row['autor'],
        'year'        => $row['anio_edicion'],
        'country'     => $row['nacionalidad_autor'],
        'age_rating'  => $row['edad_recomendada'],
        'synopsis'    => $row['sinopsis'],
        'cover_url'   => $coverUrl,
        'stock_total' => (int)$row['stock_total'],
    ];
}

$listStmt->close();

respond_json([
    'data' => $items,
    'meta' => [
        'total'     => $totalBooks,
        'page'      => $page,
        'per_page'  => $perPage,
        'found'     => count($items),
        'search'    => $search,
    ],
]);
