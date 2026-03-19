<?php

require_once __DIR__ . '/layout.php';

function sortCitiesByLength(string $input): array
{
    $cities = array_filter(array_map('trim', preg_split('/,|\s{2,}/u', $input)));

    usort($cities, function ($a, $b) {
        $lenA = mb_strlen($a);
        $lenB = mb_strlen($b);

        if ($lenA === $lenB) {
            return strcmp($a, $b); 
        }

        return $lenA <=> $lenB; 
    });

    return $cities;
}

$input = $_POST['cities'] ?? '';
$submitted = isset($_POST['cities']);
$defaultCities = 'Суми, Рівне, Луцьк, Ужгород, Тернопіль, Кропивницький, Біла Церква, Хмельницький';

if (!$submitted) {
    $input = $defaultCities;
}

$sorted = sortCitiesByLength($input);

ob_start();
?>
<div class="demo-card">
    <h2>Сортування міст (за довжиною)</h2>
    <p class="demo-subtitle">
        Спочатку за довжиною, при однаковій — за алфавітом
    </p>

    <form method="post" class="demo-form">
        <div>
            <label for="cities">Міста (через кому)</label>
            <input type="text" id="cities" name="cities"
                   value="<?= htmlspecialchars($input) ?>"
                   placeholder="Суми, Рівне, Луцьк">
        </div>
        <button type="submit" class="btn-submit">Сортувати</button>
    </form>

    <?php if (!empty($sorted)): ?>
    <div class="demo-section">
        <h3>Вхідні дані</h3>
        <div class="array-display">
            <?php foreach (array_filter(array_map('trim', explode(',', $input))) as $city): ?>
            <span class="array-item"><?= htmlspecialchars($city) ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="array-arrow">&#8595;</div>

    <div>
        <h3 class="demo-section-title-success">Відсортовані</h3>
        <div class="array-display">
            <?php foreach ($sorted as $city): ?>
            <span class="array-item array-item-unique"><?= htmlspecialchars($city) ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="demo-code">
sortCitiesByLength("<?= htmlspecialchars($input) ?>")
// Сортування за довжиною + алфавіт
// Результат: [<?= htmlspecialchars(implode(', ', array_map(fn($c) => "\"$c\"", $sorted))) ?>]
    </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 2');