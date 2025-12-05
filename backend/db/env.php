<?php

// Función simple para leer variables de entorno con valor por defecto
function env(string $key, $default = null) {
    $value = getenv($key);   // lee del entorno del sistema
    if ($value === false) {
        return $default;     // si no existe, devuelve el valor por defecto
    }
    return $value;
}
