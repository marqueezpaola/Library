<?php
require_once __DIR__ . '/env.php';

mysqli_report(MYSQLI_REPORT_OFF);

function get_db(): mysqli {
    $cn = @new mysqli(
        env('DB_HOST', 'localhost'),
        env('DB_USER', 'root'),
        env('DB_PASS', ''),
        env('DB_NAME', 'catalogo')
    );

    if ($cn->connect_errno) {
        http_response_code(500);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['error' => 'DB_CONNECTION_ERROR', 'detail' => $cn->connect_error]);
        exit;
    }

    $cn->set_charset('utf8mb4');
    return $cn;
}

function respond_json($payload, int $code = 200): void {
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *'); // para desarrollo
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

function int_between($v, $min, $max, $def) {
    $v = filter_var($v, FILTER_VALIDATE_INT);
    if ($v === false) return $def;
    return max($min, min($max, $v));
}
