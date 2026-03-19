<?php

require_once __DIR__ . '/layout.php';

function generatePassword(int $length = 13): string
{
    $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lower = 'abcdefghijklmnopqrstuvwxyz';
    $digits = '0123456789';
    $special = '!@#$%^&*()-_=+';
    $all = $upper . $lower . $digits . $special;

    $password = '';
    $password .= $upper[random_int(0, strlen($upper) - 1)];
    $password .= $lower[random_int(0, strlen($lower) - 1)];
    $password .= $digits[random_int(0, strlen($digits) - 1)];
    $password .= $special[random_int(0, strlen($special) - 1)];

    for ($i = 4; $i < $length; $i++) {
        $password .= $all[random_int(0, strlen($all) - 1)];
    }

    return str_shuffle($password);
}

function checkPasswordStrength(string $password): array
{
    $checks = [
        'length' => ['label' => 'Довжина >= 8 символів', 'passed' => strlen($password) >= 8],
        'upper' => ['label' => 'Містить велику літеру', 'passed' => (bool)preg_match('/[A-Z]/', $password)],
        'lower' => ['label' => 'Містить малу літеру', 'passed' => (bool)preg_match('/[a-z]/', $password)],
        'digit' => ['label' => 'Містить цифру', 'passed' => (bool)preg_match('/[0-9]/', $password)],
        'special' => ['label' => 'Містить спецсимвол', 'passed' => (bool)preg_match('/[^a-zA-Z0-9]/', $password)],
    ];

    $score = array_reduce($checks, fn($acc, $check) => $acc + ($check['passed'] ? 1 : 0), 0);

    $strength = match (true) {
        $score <= 1 => 'weak',
        $score <= 2 => 'fair',
        $score <= 3 => 'good',
        default => 'strong',
    };

    $labels = [
        'weak' => 'Слабкий',
        'fair' => 'Задовільний',
        'good' => 'Добрий',
        'strong' => 'Надійний',
    ];

    return [
        'strength' => $strength,
        'label' => $labels[$strength],
        'score' => $score,
        'total' => count($checks),
        'checks' => $checks,
    ];
}

$action = $_POST['action'] ?? '';
$length = (int)($_POST['length'] ?? 13);
$passwordToCheck = $_POST['password'] ?? '';

$generated = '';
$result = null;

if ($length < 4) $length = 4;
if ($length > 128) $length = 128;

if ($action === 'generate') {
    $generated = generatePassword($length);
    $result = checkPasswordStrength($generated);
} elseif ($action === 'check' && $passwordToCheck !== '') {
    $result = checkPasswordStrength($passwordToCheck);
}

ob_start();
?>
<div class="demo-card demo-card-wide">
    <h2>Генератор паролів</h2>
    <p class="demo-subtitle">Мінімум: велика, мала, цифра, спецсимвол</p>

    <div class="demo-grid-2">
        <div class="demo-panel">
            <h3 class="demo-panel-title-primary">Генерація</h3>
            <form method="post" class="demo-form">
                <input type="hidden" name="action" value="generate">
                <div>
                    <label>Довжина</label>
                    <input type="number" name="length" value="<?= $length ?>" min="4" max="128">
                </div>
                <button type="submit" class="btn-submit">Згенерувати</button>
            </form>

            <?php if ($generated): ?>
            <div class="demo-result mt-15">
                <h3>Пароль</h3>
                <div class="demo-result-value demo-mono"><?= htmlspecialchars($generated) ?></div>
            </div>
            <?php endif; ?>
        </div>
        <div class="demo-panel">
            <h3 class="demo-panel-title-success">Перевірка</h3>
            <form method="post" class="demo-form">
                <input type="hidden" name="action" value="check">
                <div>
                    <label>Пароль</label>
                    <input type="text" name="password" value="<?= htmlspecialchars($passwordToCheck) ?>">
                </div>
                <button type="submit" class="btn-submit btn-success">Перевірити</button>
            </form>
        </div>
    </div>

    <?php if ($result): ?>
    <div class="demo-section">
        <h3>
            Результат:
            <span class="demo-tag demo-tag-<?= match($result['strength']) {
                'weak' => 'error',
                'fair' => 'warning',
                'good' => 'primary',
                'strong' => 'success',
            } ?>">
                <?= htmlspecialchars($result['label']) ?>
            </span>
        </h3>

        <div class="strength-meter">
            <div class="strength-meter-fill strength-<?= $result['strength'] ?>"></div>
        </div>

        <table class="demo-table mt-15">
            <tbody>
                <?php foreach ($result['checks'] as $check): ?>
                <tr>
                    <td><?= htmlspecialchars($check['label']) ?></td>
                    <td>
                        <?php if ($check['passed']): ?>
                        <span class="demo-tag demo-tag-success">Так</span>
                        <?php else: ?>
                        <span class="demo-tag demo-tag-error">Ні</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="demo-code">
generatePassword(<?= $length ?>)
// score: <?= $result['score'] ?>/<?= $result['total'] ?>, strength: "<?= $result['strength'] ?>"
        </div>
    </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 5');