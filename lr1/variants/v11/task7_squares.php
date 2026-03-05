<?php


require_once dirname(__DIR__, 3) . '/shared/helpers/dev_reload.php';

function generateBlueCircles(int $n): string
{
    $html = "<div style='position:relative; width:100%; height:80vh; background:#ffffff; overflow:hidden; border: 1px solid #ddd; margin-top: 60px;'>";

    for ($i = 0; $i < $n; $i++) {
        $size = 80; 
        $top = mt_rand(10, 80);  
        $left = mt_rand(10, 80);
        $opacity = mt_rand(80, 100) / 100;

        $html .= "<div style='
            position:absolute;
            top:{$top}%;
            left:{$left}%;
            width:{$size}px;
            height:{$size}px;
            background-color: #0000ff; /* Синій колір */
            border-radius: 50%;        /* Робимо коло */
            opacity:{$opacity};
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        '></div>";
    }

    $html .= "</div>";
    return $html;
}

$n = 9;
$circles = generateBlueCircles($n);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 6.2 — Сині кола</title>
    <link rel="stylesheet" href="../../demo/demo.css">
</head>
<body class="task7-circles-body">
    <header class="header-fixed">
        <div class="header-left">
            <a href="/" class="header-btn">Головна</a>
            <a href="index.php" class="header-btn">← Варіант 11</a>
            <a href="/lr1/demo/task7_circles.php?from=v30" class="header-btn header-btn-demo">Demo</a>
        </div>
        <div class="header-center"></div>
        <div class="header-right">В-11 / Завд. 6.2</div>
    </header>

    <?= $circles ?>

    <div class="circles-func">generateBlueCircles(<?= $n ?>)</div>
    <div class="circles-counter">🔵 Кіл: <?= $n ?></div>
    <p class="circles-info" style="text-align: center; margin-top: 10px;">Оновіть сторінку для нової генерації 🔄</p>

    <?= devReloadScript() ?>
</body>
</html>