<?php
class Router {
    public function parseRoute(): array {
        return [
            'controller' => $_GET['c'] ?? 'index',
            'action'     => $_GET['a'] ?? 'main'
        ];
    }
}