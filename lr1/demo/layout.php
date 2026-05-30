<?php

require_once dirname(__DIR__, 2) . '/shared/helpers/dev_reload.php';
require_once dirname(__DIR__, 2) . '/shared/helpers/paths.php';

function renderDemoLayout(string $content, string $taskName, string $bodyClass = ''): void
{
    $fromVariant = $_GET['from'] ?? null;
    $currentTask = basename($_SERVER['SCRIPT_NAME']);
    $fromParam = $fromVariant ? '?from=' . htmlspecialchars($fromVariant) : '';

    $demoTasks = [
        'task2.php' => 'Завдання 2',
        'task3.php' => 'Завдання 3',
        'task4.php' => 'Завдання 4',
        'task5.php' => 'Завдання 5',
        'task6.php' => 'Завдання 6',
        'task7_table.php' => 'Завдання 7.1',
        'task7_squares.php' => 'Завдання 7.2',
    ];
    $variantUrl = null;
    if ($fromVariant && preg_match('/^v\d+$/', $fromVariant)) {
        $variantUrl = "/lr1/variants/{$fromVariant}/{$currentTask}";
    }
    ?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($taskName) ?> — Демо ЛР1</title>
    <link rel="stylesheet" href="<?= webPath(dirname(__DIR__, 2) . '/shared/css/base.css') ?>">
    <link rel="stylesheet" href="demo.css">
</head>

<body class="body-with-header <?= htmlspecialchars($bodyClass) ?>">
    <header class="header-fixed">
        <div class="header-left">
            <a href="/" class="header-btn">Головна</a>
            <a href="index.php<?= $fromVariant ? '?from=' . htmlspecialchars($fromVariant) : '' ?>" class="header-btn">←
                Демо</a>
            <?php if ($variantUrl): ?>
            <a href="<?= htmlspecialchars($variantUrl) ?>" class="header-btn header-btn-variant">← Варіант
                <?= htmlspecialchars(substr($fromVariant, 1)) ?></a>
            <?php endif; ?>
        </div>
        <div class="header-center"></div>
        <div class="header-right">
            <span class="header-variant-label">Демо</span>
            <select class="header-task-select" onchange="if(this.value) location.href=this.value">
                <?php foreach ($demoTasks as $file => $name): ?>
                <option value="<?= htmlspecialchars($file . $fromParam) ?>"
                    <?= $file === $currentTask ? 'selected' : '' ?>>
                    <?= htmlspecialchars($name) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
    </header>

    <div class="content-wrapper">
        <?= $content ?>
    </div>

    <?= devReloadScript() ?>
</body>

</html>
<?php
}
