<?php

require_once __DIR__ . '/layout.php';


function my_sin(float $x): float { return sin($x); }
function my_cos(float $x): float { return cos($x); }
function my_tan(float $x): float { return tan($x); }

function my_tg(float $x): string|float {
    $c = cos($x);
    if (abs($c) < 1e-10) return 'Не визначено (cos=0)';
    return sin($x) / $c;
}

function my_pow(float $x, float $y): float { return pow($x, $y); }

function my_factorial(int $n): string|float {
    if ($n < 0) return 'Помилка (x < 0)';
    if ($n > 170) return 'Нескінченність'; 
    if ($n <= 1) return 1;
    return $n * my_factorial($n - 1);
}

$x = isset($_POST['x']) ? (float)$_POST['x'] : null;
$y = isset($_POST['y']) ? (float)$_POST['y'] : null;

if ($x === null) {
    header('Location: task11_calc.php');
    exit;
}

$results = [
    ['name' => 'sin(x)', 'expr' => "sin($x)", 'val' => my_sin($x)],
    ['name' => 'cos(x)', 'expr' => "cos($x)", 'val' => my_cos($x)],
    ['name' => 'tg(x)', 'expr' => "tan($x)", 'val' => my_tan($x)],
    ['name' => 'my_tg(x)', 'expr' => "sin($x)/cos($x)", 'val' => my_tg($x)],
    ['name' => 'Степінь x^y', 'expr' => "{$x}^{$y}", 'val' => my_pow($x, $y)],
    ['name' => 'Факторіал x!', 'expr' => (int)$x . '!', 'val' => my_factorial((int)$x)],
];

ob_start();
?>
<div class="demo-card demo-card-wide">
    <h2>Результати обчислень</h2>

    <div style="display: flex; gap: 20px; margin-bottom: 20px;">
        <div style="flex: 1; background: #eef; padding: 15px; border-radius: 8px; text-align: center;">
            <small>Аргумент X</small><br><strong><?= $x ?></strong>
        </div>
        <div style="flex: 1; background: #eef; padding: 15px; border-radius: 8px; text-align: center;">
            <small>Степінь Y</small><br><strong><?= $y ?></strong>
        </div>
    </div>

    <table class="demo-table" style="width: 100%; border-collapse: collapse; margin-bottom: 25px;">
        <thead>
            <tr style="background: #f1f1f1;">
                <th style="padding: 12px; border: 1px solid #ddd;">Функція</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Вираз</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Результат</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $r): ?>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;"><strong><?= $r['name'] ?></strong></td>
                <td style="padding: 10px; border: 1px solid #ddd; color: #666; font-family: monospace;"><?= $r['expr'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;">
                    <?php if (is_string($r['val'])): ?>
                        <span style="color: red;"><?= $r['val'] ?></span>
                    <?php else: ?>
                        <span style="color: #2c3e50; font-weight: bold;">
                            <?= ($r['name'] === 'Факторіал x!' || $r['name'] === 'Степінь x^y') ? $r['val'] : round($r['val'], 4) ?>
                        </span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="display: flex; gap: 10px;">
        <a href="task11_calc.php?x=<?= $x ?>&y=<?= $y ?>" class="btn-secondary" style="text-decoration: none; padding: 8px 15px; border: 1px solid #ccc; color: #333;">Змінити значення</a>
        <a href="task11_calc.php" class="btn-secondary" style="text-decoration: none; padding: 8px 15px; border: 1px solid #ccc; color: #333;">Очистити</a>
    </div>

    <div class="demo-code" style="margin-top: 20px; font-size: 0.85em; background: #fafafa; padding: 10px;">
        // PHP Math Log:<br>
        pow(<?= $x ?>, <?= $y ?>) = <?= my_pow($x, $y) ?><br>
        fact(<?= (int)$x ?>) = <?= my_factorial((int)$x) ?>
    </div>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 11: Результати');