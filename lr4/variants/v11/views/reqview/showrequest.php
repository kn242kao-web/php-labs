<?php
$getParams = $getParams ?? [];
$postParams = $postParams ?? [];
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
?>

<h1>🔍 Моніторинг запитів залу</h1>

<div class="reqview-grid">
    <div class="reqview-section">
        <h2>Тестова POST-форма</h2>
        <p>Надішліть дані тренування для перевірки обробки:</p>
        
        <form method="POST" action="index.php?c=reqview&a=showrequest&source=debug" class="form">
            <div class="form__group">
                <label for="post_exercise" class="form__label">Назва вправи</label>
                <input type="text" id="post_exercise" name="exercise_name" class="form__input" placeholder="Жим лежачи">
            </div>
            <div class="form__group">
                <label for="post_type" class="form__label">Тип тренування</label>
                <select name="training_type" class="form__select">
                    <option value="power">Силове</option>
                    <option value="cardio">Кардіо</option>
                    <option value="crossfit">Кросфіт</option>
                </select>
            </div>
            <div class="form__group">
                <label for="post_weight" class="form__label">Робоча вага (кг)</label>
                <input type="number" id="post_weight" name="weight" class="form__input" placeholder="80">
            </div>
            <button type="submit" class="btn">Надіслати POST дані</button>
        </form>

        <h3 style="margin-top: 20px;">Прямі GET-параметри</h3>
        <p>Спробуйте вручну додати параметри в рядок браузера:</p>
        <code class="code-block">index.php?c=reqview&a=showrequest&gym_id=1&coach=Ivanov</code>
    </div>

    <div class="reqview-section">
        <h2>Результат аналізу</h2>
        <p><strong>Метод запиту:</strong> <code style="background: #ea580c; color: #fff; padding: 2px 6px; border-radius: 4px;"><?= htmlspecialchars($method) ?></code></p>

        <h3>GET-параметри (URL)</h3>
        <?php if (empty($getParams)): ?>
            <p class="text-muted">Масив $_GET порожній.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr><th>Ключ</th><th>Значення</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($getParams as $key => $value): ?>
                        <tr>
                            <td><code><?= htmlspecialchars($key) ?></code></td>
                            <td><?= htmlspecialchars(is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <h3>POST-параметри (Тіло запиту)</h3>
        <?php if (empty($postParams)): ?>
            <p class="text-muted">Масив $_POST порожній.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr><th>Ключ</th><th>Значення</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($postParams as $key => $value): ?>
                        <tr>
                            <td><code><?= htmlspecialchars($key) ?></code></td>
                            <td><?= htmlspecialchars(is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>