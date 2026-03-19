<?php
require_once __DIR__ . '/layout.php';

function generateAnimalNames(array $syllables, int $count = 3, int $syllablesPerName = 3): array
{
    $names = [];
    if (empty($syllables)) return [];

    for ($i = 0; $i < $count; $i++) {
        $newName = '';
        for ($j = 0; $j < $syllablesPerName; $j++) {
            $newName .= $syllables[array_rand($syllables)];
        }
        if (function_exists('mb_substr')) {
            $firstChar = mb_substr($newName, 0, 1, 'UTF-8');
            $remainder = mb_substr($newName, 1, null, 'UTF-8');
            $newName = mb_strtoupper($firstChar, 'UTF-8') . mb_strtolower($remainder, 'UTF-8');
        } else {
            $newName = ucfirst($newName); 
        }
        
        $names[] = $newName;
    }

    return $names;
}

$syllablesInput = $_POST['syllables'] ?? 'бар, ку, ло, мі, зу, тар, но, пі, ша, рі';
$namesCount = isset($_POST['count']) ? (int)$_POST['count'] : 3;
$syllablesPerName = isset($_POST['per_name']) ? (int)$_POST['per_name'] : 3;

$syllables = array_map('trim', explode(',', $syllablesInput));
$syllables = array_filter($syllables, fn($v) => $v !== '');

$generatedNames = [];
if (isset($_POST['generate']) && !empty($syllables)) {
    $generatedNames = generateAnimalNames($syllables, $namesCount, $syllablesPerName);
}

ob_start();
?>
<div class="demo-card">
    <h2>Генератор імен тварин</h2>
    <p class="demo-subtitle">Варіант 11: Створення кличок зі складів</p>

    <form method="post" class="demo-form">
        <div style="margin-bottom: 15px;">
            <label for="syllables">Доступні склади</label>
            <input type="text" id="syllables" name="syllables" value="<?= htmlspecialchars($syllablesInput) ?>">
        </div>
        
        <div style="display: flex; gap: 20px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label for="count">Кількість імен</label>
                <input type="number" id="count" name="count" value="<?= $namesCount ?>" min="1">
            </div>
            <div style="flex: 1;">
                <label for="per_name">Складів у імені</label>
                <input type="number" id="per_name" name="per_name" value="<?= $syllablesPerName ?>" min="1">
            </div>
        </div>

        <button type="submit" name="generate" class="btn-submit">Згенерувати</button>
    </form>

    <?php if (!empty($generatedNames)): ?>
    <div class="demo-section">
        <h3>Згенеровані імена:</h3>
        <div class="array-display">
            <?php foreach ($generatedNames as $name): ?>
                <span class="array-item array-item-unique"><?= htmlspecialchars($name) ?></span>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="demo-code">
        // Склади: <?= htmlspecialchars(implode('-', $syllables)) ?><br>
        // Результат: <?= !empty($generatedNames) ? implode(', ', $generatedNames) : 'очікування...' ?>
    </div>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 7');