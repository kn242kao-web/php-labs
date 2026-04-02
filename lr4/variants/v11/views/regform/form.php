<?php
$errors = $errors ?? [];
$old = $_POST ?? [];
$msg = $msg ?? '';
?>

<h1>🏋️ Калькулятор навантажень</h1>
<p>Розрахуйте параметри вашого тренування та перевірте свої знання техніки безпеки.</p>

<?php if (!empty($errors)): ?>
    <div class="alert alert--error">
        <strong>Помилки при розрахунку:</strong>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if ($msg): ?>
    <div class="alert alert--success">
        <?= htmlspecialchars($msg) ?>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?c=regform&a=form" class="form">
    <div class="form__row">
        <div class="form__group">
            <label for="num1" class="form__label">Число 1 (Вага штанги, кг)</label>
            <input type="text" id="num1" name="num1"
                   class="form__input<?= isset($errors['num1']) ? ' form__input--error' : '' ?>"
                   value="<?= htmlspecialchars($old['num1'] ?? '') ?>"
                   placeholder="Наприклад: 60">
        </div>

        <div class="form__group">
            <label for="num2" class="form__label">Число 2 (Кількість підходів)</label>
            <input type="text" id="num2" name="num2"
                   class="form__input<?= isset($errors['num2']) ? ' form__input--error' : '' ?>"
                   value="<?= htmlspecialchars($old['num2'] ?? '') ?>"
                   placeholder="Наприклад: 4">
        </div>
    </div>

    <div class="form__group">
        <label for="op" class="form__label">Функція (Математична операція)</label>
        <select id="op" name="op" class="form__select">
            <option value="+" <?= (isset($old['op']) && $old['op'] === '+') ? 'selected' : '' ?>>Сума (+)</option>
            <option value="-" <?= (isset($old['op']) && $old['op'] === '-') ? 'selected' : '' ?>>Різниця (−)</option>
            <option value="*" <?= (isset($old['op']) && $old['op'] === '*') ? 'selected' : '' ?>>Множення (×)</option>
            <option value="/" <?= (isset($old['op']) && $old['op'] === '/') ? 'selected' : '' ?>>Ділення (÷)</option>
            <option value="^" <?= (isset($old['op']) && $old['op'] === '^') ? 'selected' : '' ?>>Степінь (^)</option>
            <option value="sqrt" <?= (isset($old['op']) && $old['op'] === 'sqrt') ? 'selected' : '' ?>>Корінь квадратний (√)</option>
        </select>
    </div>

    <div class="form__group">
        <label for="user_result" class="form__label">Ваш очікуваний результат</label>
        <input type="text" id="user_result" name="user_result"
               class="form__input<?= isset($errors['user_result']) ? ' form__input--error' : '' ?>"
               value="<?= htmlspecialchars($old['user_result'] ?? '') ?>"
               placeholder="Введіть результат для перевірки сервером">
        <?php if (isset($errors['user_result'])): ?>
            <span class="form__error"><?= htmlspecialchars($errors['user_result']) ?></span>
        <?php endif; ?>
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Обчислити навантаження</button>
        <button type="reset" class="btn btn--secondary">Очистити</button>
    </div>
</form>

<div class="info-block" style="margin-top: 30px;">
    <h3>Довідка:</h3>
    <ul style="font-size: 0.9rem; color: #666; margin-left: 20px;">
        <li>При діленні друге число не може бути нулем.</li>
        <li>Корінь квадратний розраховується тільки для Числа 1 (воно має бути більше 0).</li>
        <li>Сервер перевірить ваш результат і видасть помилку, якщо він не збігається з точним розрахунком.</li>
    </ul>
</div>