<?php

// Завантаження конфігурацій та автолоадера
require_once __DIR__ . '/config/init.php';

// Ініціалізація ядра
$router = new Router();
$routeData = $router->parseRoute();

// Формуємо повну назву класу контролера та його методу
$controllerName = ucfirst($routeData['controller']) . 'Controller';
$actionName = 'action_' . $routeData['action'];

if (class_exists($controllerName)) {
    $controllerInstance = new $controllerName();
    
    if (method_exists($controllerInstance, $actionName)) {
        // Викликаємо екшен контролера
        $controllerInstance->$actionName();
    } else {
        http_response_code(404);
        die("Помилка 404: Метод дії '{$actionName}' не знайдено в класі '{$controllerName}'.");
    }
} else {
    http_response_code(404);
    die("Помилка 404: Клас контролера '{$controllerName}' не існує.");
}