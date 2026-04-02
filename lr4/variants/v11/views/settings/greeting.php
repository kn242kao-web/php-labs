<?php
$message = $message ?? '';
$currentName = $_COOKIE['user_name'] ?? '';
$currentGender = $_COOKIE['user_gender'] ?? '';
?>

<h1>👤 Профіль атлета (Cookie)</h1>
<p>Вкажіть ваші дані для персоналізації. Ми будемо вітати вас при кожному візиті до нашого залу. Дані зберігаються у вашому браузері на 30 днів.</p>

<?php if ($message !== ''): ?>
    <div class="alert alert--success"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if ($currentName !== ''): ?>
    <?php
    $titleText = ($currentGender === 'ЖІН') ? 'пані' : 'пане';
    ?>
    <div class="alert alert--info">
        <strong>Поточний статус:</strong> Вітаємо Вас, <?= $titleText ?> <?= htmlspecialchars($currentName) ?>! 🏋️‍♀️
    </div>
<?php endif; ?>

<form method="POST" action="index.php?c=settings&a=greeting" class="form">
    <div class="form__group">
        <label for="name" class="form__label">Ваше ім'я</label>
        <input type="text" id="name" name="name"
               class="form__input"
               value="<?= htmlspecialchars($currentName) ?>"
               placeholder="Як до вас звертатися?">
    </div>

    <div class="form__group">
        <span class="form__label">Ваша стать</span>
        <div class="form__radio-group" style="display: flex; gap: 20px; margin-top: 10px;">
            <label class="form__radio" style="cursor: pointer; display: flex; align-items: center; gap: 8px;">
                <input type="radio" name="gender" value="ЧОЛ"
                       <?= ($currentGender === 'ЧОЛ' || $currentGender === '') ? 'checked' : '' ?>>
                Чоловіча (пане)
            </label>
            <label class="form__radio" style="cursor: pointer; display: flex; align-items: center; gap: 8px;">
                <input type="radio" name="gender" value="ЖІН"
                       <?= $currentGender === 'ЖІН' ? 'checked' : '' ?>>
                Жіноча (пані)
            </label>
        </div>
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Зберегти налаштування</button>
        <a href="index.php?c=index&a=main" class="btn btn--secondary">На головну</a>
    </div>
</form>

<div class="info-block" style="margin-top: 30px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
    <p style="font-size: 0.85rem; color: #64748b;">
        ℹ️ <strong>Технічна довідка:</strong> Ці дані записуються в <code>$_COOKIE</code> за допомогою функції <code>setcookie()</code>. 
        На відміну від сесій, ці дані залишаться навіть після закриття браузера, поки не вийде термін дії (30 днів).
    </p>
</div>