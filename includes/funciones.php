<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function pagina_actual($path) {
    $url_actual = $_SERVER['PATH_INFO'] ?? urldecode(strtok($_SERVER['REQUEST_URI'], '?')) ?? '/';
    return strpos($url_actual, $path) !== false;
}

function is_directivo() : bool {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $is_directivo = isset($_SESSION['directivo']) && $_SESSION['directivo'] === '1';
    // error_log("is_admin: " . ($is_admin ? 'true' : 'false')); // Para depuración
    return $is_directivo;
}
