<?php
session_start();
spl_autoload_register(function ($class) {
    $paths = [__DIR__.'/../classes/', __DIR__.'/../controllers/'];
    foreach ($paths as $path) {
        if (file_exists($f = $path . $class . '.php')) require_once $f;
    }
});