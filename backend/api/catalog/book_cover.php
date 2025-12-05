<?php
// backend/api/cover.php
require_once __DIR__ . '/../../db/sql_conection.php';

$db = get_db();
$libroId = isset($_GET['libro_id']) ? (int)$_GET['libro_id'] : 0;

if ($libroId <= 0) {
    http_response_code(400);
    exit('Invalid libro_id');
}

// Buscar portada principal de este libro
$sql = "
    SELECT drive_file_id, url, mime_type
    FROM b_portada
    WHERE libro_id = ? AND es_principal = 1
    LIMIT 1
";
$stmt = $db->prepare($sql);
$stmt->bind_param('i', $libroId);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$stmt->close();

if (!$row) {
    // si no hay portada - mandar placeholder local
    header('Content-Type: image/png');
    readfile(__DIR__ . '/../../../frontend/public/assets/img/placeholder-cover.png');
    exit;
}

// Resolver el ID de Drive
$driveId = null;

if (!empty($row['drive_file_id'])) {
    $driveId = trim($row['drive_file_id']);
} elseif (!empty($row['url'])) {
    // Intentar extraer de https://drive.google.com/file/d/ID/...
    if (preg_match('~https://drive\.google\.com/file/d/([^/]+)/~', $row['url'], $m)) {
        $driveId = $m[1];
    }
}

if (empty($driveId)) {
    header('Content-Type: image/png');
    readfile(__DIR__ . '/../../../frontend/public/assets/img/placeholder-cover.png');
    exit;
}

// Construir URLs candidatas a probar en el servidor
$candidates = [
    // Thumbnail de Drive devuelve la imagen directa
    'https://drive.google.com/thumbnail?id=' . rawurlencode($driveId) . '&sz=w800',
    'https://drive.google.com/uc?export=download&id=' . rawurlencode($driveId),
];

$imageData = null;
$mime      = !empty($row['mime_type']) ? $row['mime_type'] : 'image/jpeg';

foreach ($candidates as $url) {
    $context = stream_context_create([
        'http' => [
            'method'  => 'GET',
            'timeout' => 15,
        ],
    ]);

    $fh = @fopen($url, 'rb', false, $context);
    if ($fh) {
        $data = stream_get_contents($fh);
        fclose($fh);

        if ($data !== false && strlen($data) > 0) {
            $imageData = $data;
            break;
        }
    }
}

// Si no logramos obtenerla, usar placeholder
if ($imageData === null) {
    header('Content-Type: image/png');
    readfile(__DIR__ . '/../../../frontend/public/assets/img/placeholder-cover.png');
    exit;
}

//Enviar la imagen al navegador
header('Content-Type: ' . $mime);
echo $imageData;
exit;
