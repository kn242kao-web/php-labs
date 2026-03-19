<?php
require_once __DIR__ . '/layout.php';

function findAndReplace(string $text, string $find, string $replace): string
{
    if ($find === '') {
        return $text;
    }
    return str_replace($find, $replace, $text);
}

$text = $_POST['text'] ?? 'Учні нашої школи щороку беруть участь у олімпіадах з математики та фізики і здобувають нагороди';
$find = $_POST['find'] ?? 'і';
$replace = $_POST['replace'] ?? 'та';
$result = '';
$submitted = isset($_POST['text']);

if ($submitted && $find !== '') {
    $result = findAndReplace($text, $find, $replace);
}

ob_start();
?>
<div class="demo-card">
    <h2>Знайти і замінити</h2>
    <p class="demo-subtitle">Заміна символів/підрядків у тексті</p>

    <form method="post" class="demo-form">
        <div>
            <label for="text">Текст</label>
            <textarea id="text" name="text" rows="3"><?= htmlspecialchars($text) ?></textarea>
        </div>
        <div class="form-row">
            <div>
                <label for="find">Знайти</label>
                <input type="text" id="find" name="find" value="<?= htmlspecialchars($find) ?>">
            </div>
            <div>
                <label for="replace">Замінити на</label>
                <input type="text" id="replace" name="replace" value="<?= htmlspecialchars($replace) ?>">
            </div>
        </div>
        <button type="submit" class="btn-submit">Замінити</button>
    </form>

    <?php if ($submitted && $find !== ''): ?>
    <div class="demo-result">
        <h3>Результат</h3>
        <div class="demo-result-value"><?= htmlspecialchars($result) ?></div>
    </div>
    <div class="demo-code">
        findAndReplace(text, "<?= htmlspecialchars($find) ?>", "<?= htmlspecialchars($replace) ?>")
    </div>
    <?php elseif ($submitted && $find === ''): ?>
    <div class="demo-result demo-result-error">
        <h3>Помилка</h3>
        <div class="demo-result-value">Поле "Знайти" не може бути порожнім</div>
    </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 1');