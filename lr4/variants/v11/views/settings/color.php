<?php
$colors = $colors ?? [
    '#f8fafc' => 'Світла сталь (Стандарт)',
    '#e2e8f0' => 'Холодний метал',
    '#fff7ed' => 'Енергія (Беж)',
    '#f1f5f9' => 'Атлетичний сірий',
    '#ecfdf5' => 'Свіжість (М’ята)'
];
$currentColor = $_SESSION['bg_color'] ?? '#f8fafc';
$message = $message ?? '';
?>

<h1>🎨 Налаштування атмосфери залу</h1>
<p>Оберіть колір фону, який допоможе вам краще зосередитися на тренуваннях. Вибір буде збережено у вашій сесії.</p>

<?php if ($message !== ''): ?>
    <div class="alert alert--success"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form method="POST" action="index.php?c=settings&a=color" class="form">
    <div class="color-picker" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; margin: 25px 0;">
        <?php foreach ($colors as $hex => $name): ?>
            <label class="color-swatch <?= $hex === $currentColor ? 'color-swatch--active' : '' ?>" style="cursor: pointer; text-align: center; border: 2px solid <?= $hex === $currentColor ? '#ea580c' : '#e2e8f0' ?>; padding: 15px; border-radius: 12px; background: #fff;">
                <input type="radio" name="color" value="<?= htmlspecialchars($hex) ?>" 
                       <?= $hex === $currentColor ? 'checked' : '' ?> style="display: none;">
                
                <div class="color-swatch__preview" 
                     style="width: 50px; height: 50px; background-color: <?= htmlspecialchars($hex) ?>; border-radius: 50%; margin: 0 auto 10px; border: 1px solid #ddd; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);">
                </div>
                
                <span class="color-swatch__name" style="font-weight: 600; font-size: 0.9rem; color: #1e293b;">
                    <?= htmlspecialchars($name) ?>
                </span>
            </label>
        <?php endforeach; ?>
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Застосувати стиль</button>
        <a href="index.php?c=index&a=main" class="btn btn--secondary">Скасувати</a>
    </div>
</form>

<div class="info-block" style="margin-top: 30px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
    <p style="font-size: 0.85rem; color: #64748b;">
        ℹ️ <strong>Як це працює:</strong> Обраний колір записується в масив <code>$_SESSION</code> на сервері. 
        При кожному завантаженні сторінки файл <code>header.php</code> зчитує це значення і підставляє його в атрибут <code>style="background-color: ..."</code> тега <code>body</code>.
    </p>
</div>