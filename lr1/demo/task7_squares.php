<?php
require_once __DIR__ . '/layout.php';

function generateRandomSquares(int $n): string
{
    $html = "<div class='shapes-container shapes-container--black'>";

    for ($i = 0; $i < $n; $i++) {
        $size = mt_rand(20, 100);
        $top = mt_rand(0, 90);
        $left = mt_rand(0, 90);
        $opacity = mt_rand(70, 100) / 100;

        $html .= "<div class='square' style='
            position:absolute;
            width:{$size}px;
            height:{$size}px;
            top:{$top}%;
            left:{$left}%;
            background:red;
            opacity:{$opacity};
        '></div>";
    }

    $html .= "</div>";
    return $html;
}

$n = 15;

$squares = generateRandomSquares($n);

$content = $squares . '
    <div class="circles-func">generateRandomSquares(' . $n . ')</div>
    <div class="circles-counter">🟥 Квадратів: ' . $n . '</div>
    <p class="circles-info">Оновіть сторінку для нової композиції 🔄</p>';

renderDemoLayout($content, 'Завдання 7.2', 'task7-circles-body');
