<?php
// backend/api/env.php
// Carga las variables desde .env.local (en la raíz del proyecto)

function env($key, $default = null) {
    static $ENV = null;

    if ($ENV === null) {
        // subimos desde /backend/api/ a la raíz
        $root = dirname(__DIR__, 1); // /backend
        $path = $root . '/../.env.local';

        if (file_exists($path)) {
            $ENV = parse_ini_file($path, false, INI_SCANNER_TYPED);
        } else {
            $ENV = [];
        }
    }

    return array_key_exists($key, $ENV) ? $ENV[$key] : $default;
}



