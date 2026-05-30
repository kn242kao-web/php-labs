<?php
require_once __DIR__ . '/layout.php';

function generateColorTable(int $n): string
{
    $html = "<table class='chessboard'>";
    for ($i = 0; $i < $n; $i++) {
        $html .= "<tr>";
        for ($j = 0; $j < $n; $j++) {
            $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $html .= "<td style='background-color:$color;'></td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

$n = 5;

$table = generateColorTable($n);

$content = '
    <h1>🎨 Кольорова таблиця ' . $n . '×' . $n . '</h1>
    <div class="params">generateColorTable(' . $n . ')</div>
    ' . $table . '
    <p class="info info-light mt-20">Оновіть сторінку для нових кольорів 🔄</p>';

renderDemoLayout($content, 'Завдання 7.1', 'task7-table-body');
