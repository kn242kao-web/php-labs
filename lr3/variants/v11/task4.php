<?php
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/Book.php';
$book3 = new Book('Захар Беркут', 'Іван Франко', 1883);

$book4 = clone $book3;

ob_start();
?>

<div class="task-header">
    <h1>Клонування</h1>
    <p>Метод <code>__clone()</code> задає значення за замовчуванням при копіюванні об'єкта <code>Book</code></p>
</div>

<div class="code-block">
<span class="code-comment">// Метод __clone() у класі Book</span>
<span class="code-keyword">public function</span> <span class="code-method">__clone</span>(): <span class="code-class">void</span>
{
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">title</span> = <span class="code-string">'Без назви'</span>;
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">author</span> = <span class="code-string">''</span>;
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">year</span> = <span class="code-number">0</span>;
}

<span class="code-comment">// Створюємо 4-й об'єкт через clone</span>
<span class="code-variable">$book4</span> = <span class="code-keyword">clone</span> <span class="code-variable">$book3</span>;
</div>

<div class="section-divider">
    <span class="section-divider-text">Оригінал vs Клон</span>
</div>

<div class="comparison-wrapper">
    <div class="users-grid">
        <div class="user-card">
            <div class="user-card-header">
                <div class="user-card-avatar avatar-amber">З</div>
                <div>
                    <div class="user-card-name"><?= htmlspecialchars($book3->title) ?></div>
                    <div class="user-card-label">$book3 <span class="user-card-badge badge-constructor">original</span></div>
                </div>
            </div>
            <div class="user-card-body">
                <div class="user-card-field">
                    <span class="user-card-field-label">title</span>
                    <span class="user-card-field-value"><?= htmlspecialchars($book3->title) ?></span>
                </div>
                <div class="user-card-field">
                    <span class="user-card-field-label">author</span>
                    <span class="user-card-field-value"><?= htmlspecialchars($book3->author) ?></span>
                </div>
                <div class="user-card-field">
                    <span class="user-card-field-label">year</span>
                    <span class="user-card-field-value"><?= $book3->year ?> р.</span>
                </div>
            </div>
        </div>

        <div class="user-card">
            <div class="user-card-header">
                <div class="user-card-avatar avatar-rose">Б</div>
                <div>
                    <div class="user-card-name"><?= htmlspecialchars($book4->title) ?></div>
                    <div class="user-card-label">$book4 <span class="user-card-badge badge-clone">clone</span></div>
                </div>
            </div>
            <div class="user-card-body">
                <div class="user-card-field">
                    <span class="user-card-field-label">title</span>
                    <span class="user-card-field-value"><?= htmlspecialchars($book4->title) ?></span>
                </div>
                <div class="user-card-field">
                    <span class="user-card-field-label">author</span>
                    <span class="user-card-field-value"><em>(порожньо)</em></span>
                </div>
                <div class="user-card-field">
                    <span class="user-card-field-label">year</span>
                    <span class="user-card-field-value"><?= $book4->year ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-divider">
    <span class="section-divider-text">getInfo() порівняння</span>
</div>

<div class="info-output">
    <div class="info-output-header">Результат getInfo() для оригіналу та клону</div>
    <div class="info-output-body">
        <div class="info-output-row">
            <span class="info-output-label">$book3</span>
            <span class="info-output-text"><?= htmlspecialchars($book3->getInfo()) ?></span>
        </div>
        <div class="info-output-row">
            <span class="info-output-label">$book4</span>
            <span class="info-output-text"><?= htmlspecialchars($book4->getInfo()) ?></span>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 4', 'task4-body');