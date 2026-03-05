<?php
require_once dirname(__DIR__, 3) . '/shared/helpers/dev_reload.php';

function generateChessboardTable(int $rows, int $cols, string $color1, string $color2): string
{
    $html = "<table class='chessboard' style='border-collapse: collapse;'>";
    for ($i = 0; $i < $rows; $i++) {
        $html .= "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            $bgColor = (($i + $j) % 2 === 0) ? $color1 : $color2;
            
            $html .= "<td style='background-color:{$bgColor}; width: 40px; height: 40px; border: 1px solid rgba(0,0,0,0.1);'></td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

$rows = 4;
$cols = 11;
$color1 = '#000000'; 
$color2 = '#ffffff'; 

$table = generateChessboardTable($rows, $cols, $color1, $color2);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 6.2 — Шахова таблиця</title>
    <link rel="stylesheet" href="../../demo/demo.css">
    <style>
        .chessboard {
            margin: 20px auto;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body class="task7-table-body body-with-header">
    <header class="header-fixed">
        <div class="header-left">
            <a href="/" class="header-btn">Головна</a>
            <a href="index.php" class="header-btn">← Варіант 11</a>
        </div>
        <div class="header-right">В-11 / Шахи</div>
    </header>

    <h1>🏁 Шахова таблиця <?= $rows ?>×<?= $cols ?></h1>
    <div class="params">generateChessboardTable(<?= $rows ?>, <?= $cols ?>, "<?= $color1 ?>", "<?= $color2 ?>")</div>

    <div style="display: flex; justify-content: center;">
        <?= $table ?>
    </div>

    <?= devReloadScript() ?>
</body>
</html>
