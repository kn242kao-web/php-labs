<?php
class PageView {
    private string $title = 'PowerGym';
    public function setTitle(string $title) { $this->title = $title; }

    public function render(string $template, array $data = []) {
        extract($data);
        $bgColor = $_SESSION['bg_color'] ?? '#ffffff';
        $userName = $_COOKIE['user_name'] ?? '';
        $userGender = $_COOKIE['user_gender'] ?? '';

        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/' . $template . '.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }
}