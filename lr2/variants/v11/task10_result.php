<?php

session_start();
require_once __DIR__ . '/layout.php';
$hobbiesMap = [
    'coding' => 'Програмування',
    'gym' => 'Спортзал',
    'gaming' => 'Ігри',
    'photo' => 'Фотографія'
];

$genderMap = [
    'male' => 'Чоловіча',
    'female' => 'Жіноча'
];
$data = $_SESSION['user_reg'] ?? null;

$languages = [
    'uk' => '🇺🇦 Українська',
    'en' => '🇬🇧 English',
    'pl' => '🇵🇱 Polski',
];
$lang = $_COOKIE['lang'] ?? 'uk';
$currentLangName = $languages[$lang] ?? $languages['uk'];

ob_start();
?>
<div class="demo-card demo-card-wide">
    <h2>Профіль користувача: <?= htmlspecialchars($data['login'] ?? 'Гість') ?></h2>

    <div class="lang-notice" style="margin-bottom: 20px; font-size: 0.9em; color: #666;">
        Обрана мова інтерфейсу: <strong><?= $currentLangName ?></strong>
    </div>

    <?php if ($data): ?>
        <div class="demo-result demo-result-success" style="background: #e7f3ff; border-left: 4px solid #2196F3; padding: 15px; margin-bottom: 25px;">
            <h3 style="margin-top: 0;">Реєстрація успішна!</h3>
            <p style="margin-bottom: 0;">Ваші дані надійно збережені в сесії сервера.</p>
        </div>

        <div class="result-data" style="display: flex; flex-direction: column; gap: 12px;">
            <div style="display: flex; border-bottom: 1px solid #eee; padding-bottom: 8px;">
                <span style="font-weight: bold; width: 150px;">Логін:</span>
                <span><?= htmlspecialchars($data['login']) ?></span>
            </div>

            <div style="display: flex; border-bottom: 1px solid #eee; padding-bottom: 8px;">
                <span style="font-weight: bold; width: 150px;">Стать:</span>
                <span><?= $genderMap[$data['gender']] ?? 'Не вказано' ?></span>
            </div>

            <div style="display: flex; border-bottom: 1px solid #eee; padding-bottom: 8px;">
                <span style="font-weight: bold; width: 150px;">Місто:</span>
                <span><?= htmlspecialchars($data['city']) ?></span>
            </div>

            <div style="display: flex; border-bottom: 1px solid #eee; padding-bottom: 8px;">
                <span style="font-weight: bold; width: 150px;">Хобі:</span>
                <div>
                    <?php 
                    if (!empty($data['hobbies'])): 
                        foreach ($data['hobbies'] as $hKey): 
                            $label = $hobbiesMap[$hKey] ?? $hKey;
                    ?>
                        <span class="demo-tag demo-tag-primary" style="background: #e1ecf4; color: #39739d; padding: 2px 8px; border-radius: 4px; font-size: 0.85em; margin-right: 5px;">
                            <?= htmlspecialchars($label) ?>
                        </span>
                    <?php 
                        endforeach; 
                    else: 
                        echo "Не обрано"; 
                    endif; 
                    ?>
                </div>
            </div>

            <div style="display: flex; border-bottom: 1px solid #eee; padding-bottom: 8px;">
                <span style="font-weight: bold; width: 150px;">Про себе:</span>
                <span style="flex: 1;"><?= nl2br(htmlspecialchars($data['about'] ?: 'Інформація відсутня')) ?></span>
            </div>

            <?php if (!empty($data['photo']) && file_exists(__DIR__ . '/' . $data['photo'])): ?>
            <div style="display: flex; padding-top: 10px;">
                <span style="font-weight: bold; width: 150px;">Аватар:</span>
                <div>
                    <img src="<?= htmlspecialchars($data['photo']) ?>" alt="User Photo" style="max-width: 200px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div style="margin-top: 30px;">
            <a href="task10_form.php" class="btn-secondary" style="text-decoration: none; color: #666; border: 1px solid #ccc; padding: 8px 15px; border-radius: 4px;">
                ← Повернутися до редагування
            </a>
        </div>

    <?php else: ?>
        <div class="demo-result demo-result-error" style="background: #fff0f0; border-left: 4px solid #f44336; padding: 15px;">
            <h3>Помилка доступу</h3>
            <p>Дані сесії порожні. Будь ласка, заповніть форму реєстрації.</p>
            <a href="task10_form.php" class="btn-submit" style="display: inline-block; margin-top: 10px; text-decoration: none;">
                Перейти до форми
            </a>
        </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 10: Результат');