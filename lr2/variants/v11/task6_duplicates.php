<?php

require_once __DIR__ . '/layout.php';

function findUnique(array $arr): array
{
    $counts = array_count_values($arr);
    return array_values(array_filter($arr, fn($v) => $counts[$v] === 1));
}

$input = $_POST['array'] ?? '3, 7, 2, 7, 5, 3, 9, 1, 5, 8, 4, 9';
$submitted = isset($_POST['array']);

$arr = array_map('trim', explode(',', $input));
$arr = array_filter($arr, fn($v) => $v !== '');

$unique = findUnique($arr);

ob_start();
?>
<div class="demo-card">
    <h2>Унікальні елементи масиву</h2>
    <p class="demo-subtitle">Знаходить елементи, що зустрічаються лише один раз</p>

    <form method="post" class="demo-form">
        <div>
            <label for="array">Масив (через кому)</label>
            <input type="text" id="array" name="array"
                   value="<?= htmlspecialchars($input) ?>"
                   placeholder="3, 7, 2, 7, 5">
        </div>
        <button type="submit" class="btn-submit">Знайти</button>
    </form>

    <?php if (!empty($arr)): ?>
    <div class="demo-section">
        <h3>Вхідний масив</h3>
        <div class="array-display">
            <?php foreach ($arr as $item): ?>
            <span class="array-item <?= in_array($item, $unique) ? 'array-item-unique' : '' ?>">
                <?= htmlspecialchars($item) ?>
            </span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="array-arrow">&#8595;</div>

    <div class="demo-result">
        <h3>Унікальні елементи</h3>
        <div class="demo-result-value">
            [<?= htmlspecialchars(implode(', ', $unique)) ?>]
        </div>
    </div>

    <div class="demo-section">
        <h3>Частота елементів</h3>
        <table class="demo-table">
            <thead>
                <tr>
                    <th>Елемент</th>
                    <th>Кількість</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counts = array_count_values($arr);
                foreach ($counts as $value => $count):
                ?>
                <tr>
                    <td><?= htmlspecialchars($value) ?></td>
                    <td><?= $count ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="demo-code">
findUnique([<?= htmlspecialchars(implode(', ', $arr)) ?>])
// Результат: [<?= htmlspecialchars(implode(', ', $unique)) ?>]
    </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 6');