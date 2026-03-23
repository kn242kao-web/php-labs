<?php

require_once __DIR__ . '/layout.php';

ob_start();
?>
<div class="demo-card">
    <h2>Математичний калькулятор</h2>
    <p class="demo-subtitle">Обчислення тригонометричних та алгебраїчних функцій</p>

    <form method="post" action="task11_result.php" class="demo-form">
        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
            <div style="flex: 1;">
                <label for="x">Значення X (основа / аргумент)</label>
                <input type="number" id="x" name="x" step="any" value="<?= htmlspecialchars($_GET['x'] ?? '5') ?>" required style="width: 100%; padding: 8px;">
            </div>
            <div style="flex: 1;">
                <label for="y">Значення Y (степінь)</label>
                <input type="number" id="y" name="y" step="any" value="<?= htmlspecialchars($_GET['y'] ?? '2') ?>" required style="width: 100%; padding: 8px;">
            </div>
        </div>
        <button type="submit" class="btn-submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer;">
            Обчислити результати
        </button>
    </form>

    <div class="demo-section" style="margin-top: 30px;">
        <h3>Методи обчислення</h3>
        <table class="demo-table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa;">
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Функція</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Опис</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;"><code>sin(x), cos(x)</code></td>
                    <td style="padding: 8px; border: 1px solid #ddd;">Тригонометричні функції в радіанах</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;"><code>tg(x) vs my_tg(x)</code></td>
                    <td style="padding: 8px; border: 1px solid #ddd;">Вбудований тангенс проти розрахунку sin/cos</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;"><code>x^y</code></td>
                    <td style="padding: 8px; border: 1px solid #ddd;">Піднесення числа до степеня</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;"><code>x!</code></td>
                    <td style="padding: 8px; border: 1px solid #ddd;">Факторіал цілого числа (рекурсія)</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 11');