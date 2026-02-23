<?php
/**
 * Варіант 11 — Головна сторінка ЛР1
 */

$templatePath = dirname(__DIR__, 3) . '/shared/templates/task_cards.php';

if (file_exists($templatePath)) {
    require_once $templatePath;
}

$v = 11; 
$lab = 1;
$demoUrl = "/lr1/v{$v}/index.php?from=v{$v}";

$tasks = [
    'task1.php' => ['name' => 'Завдання 1'],
    'task2.php' => ['name' => 'Завдання 2'],
    'task3.php' => ['name' => 'Завдання 3'],
    'task4.php' => ['name' => 'Завдання 4'],
    'task5.php' => ['name' => 'Завдання 5'],
    'task6.php' => ['name' => 'Завдання 6'],
];
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Варіант <?= $v ?> — ЛР<?= $lab ?></title>
    
    <link rel="stylesheet" href="../../demo/demo.css">
    
    <style>
        body {
            background-color: #fff9f0;
            margin: 0;
            font-family: 'Times New Roman', serif;
        }
        .header-fixed {
            display: flex;
            justify-content: space-between;
            padding: 15px 40px;
            background: #fff;
            border-bottom: 1px solid #eee;
        }
        .header-btn {
            color: #0000ee;
            text-decoration: none;
        }
        .index-title {
            text-align: center;
            margin-top: 60px;
            font-size: 3rem;
            color: #333;
        }
        .index-subtitle {
            font-size: 1.5rem;
            color: #777;
            font-weight: normal;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body class="index-page">

    <header class="header-fixed">
        <div class="header-left">
            <a href="/" class="header-btn">Головна ← Варіант <?= $v ?> Demo</a>
        </div>
        <div class="header-right">
            <strong>В-<?= $v ?></strong> Завдання ▾
        </div>
    </header>

    <main class="container">
        <h1 class="index-title">
            Варіант <?= $v ?>
            <br>
            <span class="index-subtitle">Лабораторна робота №<?= $lab ?></span>
        </h1>

        <div class="tasks-wrapper">
            <?php 
            if (function_exists('renderTaskCards')) {
                echo renderTaskCards($tasks, true, $demoUrl); 
            } else {
                echo "<p style='text-align:center; color:red;'>Помилка: Не вдалося завантажити картки завдань.</p>";
            }
            ?>
        </div>
    </main>

</body>
</html>