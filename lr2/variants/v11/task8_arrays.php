<?php
require_once __DIR__ . '/layout.php';

function createArray(): array
{
    $length = random_int(4, 8);
    $arr = [];
    for ($i = 0; $i < $length; $i++) {
        $arr[] = random_int(1, 50);
    }
    return $arr;
}

function mergeUniqueDescending(array $a, array $b): array
{
    $merged = array_merge($a, $b);
    $unique = array_unique($merged);
    rsort($unique);
    
    return $unique;
}

$arr1 = createArray();
$arr2 = createArray();

$result = mergeUniqueDescending($arr1, $arr2);

ob_start();
?>
<div class="demo-card demo-card-wide">
    <h2>Операції з масивами</h2>
    <p class="demo-subtitle">Об'єднання масивів, array_unique та rsort (за спаданням)</p>

    <form method="post" class="demo-form">
        <button type="submit" name="regenerate" class="btn-submit">Згенерувати нові масиви</button>
    </form>

    <div class="demo-section">
        <h3>Масив 1 (довжина <?= count($arr1) ?>)</h3>
        <div class="array-display">
            <?php foreach ($arr1 as $v): ?>
            <span class="array-item"><?= $v ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="demo-section">
        <h3>Масив 2 (довжина <?= count($arr2) ?>)</h3>
        <div class="array-display">
            <?php foreach ($arr2 as $v): ?>
            <span class="array-item"><?= $v ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="array-arrow">&#8595; Об'єднання → Унікальні → Сортування (max to min)</div>

    <div>
        <h3 class="demo-section-title-success">Результат (За спаданням)</h3>
        <?php if (!empty($result)): ?>
        <div class="array-display">
            <?php foreach ($result as $v): ?>
            <span class="array-item array-item-unique"><?= $v ?></span>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p class="demo-subtitle">Масиви порожні</p>
        <?php endif; ?>
    </div>

    <div class="demo-code">
$a = [<?= implode(', ', $arr1) ?>];
$b = [<?= implode(', ', $arr2) ?>];
$result = mergeUniqueDescending($a, $b);
// Сортування rsort() успішне.
// Результат: [<?= implode(', ', $result) ?>]
    </div>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 8');