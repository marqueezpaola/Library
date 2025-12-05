<?php
require_once __DIR__ . '/../../db/sql_conection.php';

// ESTO ES EL LISTADO DE LOS LIBROS
$db = get_db();

$page     = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$perPage  = isset($_GET['per_page']) ? max(1, min(100, (int)$_GET['per_page'])) : 24;
$search   = isset($_GET['q']) ? trim($_GET['q']) : '';

$offset = ($page - 1) * $perPage;

$where  = "l.ESTADO_SQL = 1";
$params = [];
$types  = '';

if ($search !== '') {
    $where .= " AND (l.titulo LIKE ? OR l.autor LIKE ? OR l.isbn LIKE ?)";
    $like = '%' . $search . '%';
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $types   .= 'sss';
}

// COUNT
$countSql = "SELECT COUNT(*) AS total FROM b_libro l WHERE $where";
$countStmt = $db->prepare($countSql);
if ($types !== '') {
    $countStmt->bind_param($types, ...$params);
}
$countStmt->execute();
$countResult = $countStmt->get_result()->fetch_assoc();
$totalBooks  = (int)($countResult['total'] ?? 0);
$countStmt->close();

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
    ORDER BY l.titulo ASC
    LIMIT ? OFFSET ?
";

$listStmt = $db->prepare($listSql);

$paramsWithLimit = $params;
$typesWithLimit  = $types . 'ii';
$paramsWithLimit[] = $perPage;
$paramsWithLimit[] = $offset;

$listStmt->bind_param($typesWithLimit, ...$paramsWithLimit);
$listStmt->execute();
$result = $listStmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {

// CONEXION CON EL DB DE DRIVE
$driveId = trim((string)($row['portada_drive_id'] ?? ''));
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
