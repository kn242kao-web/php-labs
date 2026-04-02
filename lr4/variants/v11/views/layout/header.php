<?php
$bgColor = $_SESSION['bg_color'] ?? '#f8fafc';
$greetingName = $_COOKIE['user_name'] ?? '';
$greetingGender = $_COOKIE['user_gender'] ?? '';

$greetingText = '';
if ($greetingName !== '') {
    $title = ($greetingGender === 'ЖІН') ? 'пані' : 'пане';
    $greetingText = "Вітаємо Вас, {$title} " . htmlspecialchars($greetingName) . "!";
}

$currentController = $_GET['c'] ?? 'index';
$currentAction = $_GET['a'] ?? 'main';
$currentFullRoute = "{$currentController}/{$currentAction}";

$navItems = [
    'index/main' => 'Головна',
    'regform/form' => 'Калькулятор',
    'reqview/showrequest' => 'Параметри',
    'settings/color' => 'Колір фону',
    'settings/greeting' => 'Профіль',
];
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'PowerGym') ?> — Тренажерний зал</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color: <?= htmlspecialchars($bgColor) ?>">
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <a href="index.php" class="header__logo">🏋️ PowerGym</a>
                <?php if ($greetingText !== ''): ?>
                    <span class="header__greeting"><?= $greetingText ?></span>
                <?php endif; ?>
            </div>
            <nav class="nav">
                <ul class="nav__list">
                    <?php foreach ($navItems as $route => $label): 
                        list($ctrl, $act) = explode('/', $route);
                    ?>
                        <li class="nav__item">
                            <a href="index.php?c=<?= $ctrl ?>&a=<?= $act ?>"
                               class="nav__link<?= $currentFullRoute === $route ? ' nav__link--active' : '' ?>">
                                <?= htmlspecialchars($label) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main class="main">
        <div class="container">