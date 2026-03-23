<?php
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/Book.php';
$book1 = new Book('Тіні забутих предків', 'Михайло Коцюбинський', 1911);
$book2 = new Book('Кайдашева сім\'я', 'Іван Нечуй-Левицький', 1879);
$book3 = new Book('Захар Беркут', 'Іван Франко', 1883);

$books = [
    ['obj' => $book1, 'avatar' => 'avatar-indigo', 'initial' => 'Т', 'var' => '$book1'],
    ['obj' => $book2, 'avatar' => 'avatar-green', 'initial' => 'К', 'var' => '$book2'],
    ['obj' => $book3, 'avatar' => 'avatar-amber', 'initial' => 'З', 'var' => '$book3'],
];

ob_start();
?>

<div class="task-header">
    <h1>Конструктор</h1>
    <p>Початкові значення задаються одразу при створенні об'єкта <code>Book</code></p>
</div>

<div class="code-block">
<span class="code-comment">// Конструктор класу Book</span>
<span class="code-keyword">public function</span> <span class="code-method">__construct</span>(<span class="code-class">string</span> <span class="code-variable">$title</span>, <span class="code-class">string</span> <span class="code-variable">$author</span>, <span class="code-class">int</span> <span class="code-variable">$year</span>)
{
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">title</span> = <span class="code-variable">$title</span>;
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">author</span> = <span class="code-variable">$author</span>;
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">year</span> = <span class="code-variable">$year</span>;
}

<span class="code-comment">// Створення об'єктів в один рядок</span>
<span class="code-variable">$book1</span> = <span class="code-keyword">new</span> <span class="code-class">Book</span>(<span class="code-string">'Тіні забутих предків'</span>, <span class="code-string">'М. Коцюбинський'</span>, <span class="code-number">1911</span>);
<span class="code-variable">$book2</span> = <span class="code-keyword">new</span> <span class="code-class">Book</span>(<span class="code-string">'Кайдашева сім\'я'</span>, <span class="code-string">'І. Нечуй-Левицький'</span>, <span class="code-number">1879</span>);
<span class="code-variable">$book3</span> = <span class="code-keyword">new</span> <span class="code-class">Book</span>(<span class="code-string">'Захар Беркут'</span>, <span class="code-string">'І. Франко'</span>, <span class="code-number">1883</span>);
</div>

<div class="section-divider">
    <span class="section-divider-text">Об'єкти створені через конструктор</span>
</div>

<div class="users-grid">
    <?php foreach ($books as $data): ?>
    <div class="user-card">
        <div class="user-card-header">
            <div class="user-card-avatar <?= $data['avatar'] ?>"><?= $data['initial'] ?></div>
            <div>
                <div class="user-card-name"><?= htmlspecialchars($data['obj']->title) ?></div>
                <div class="user-card-label"><?= $data['var'] ?> <span class="user-card-badge badge-constructor">constructor</span></div>
            </div>
        </div>
        <div class="user-card-body">
            <div class="user-card-field">
                <span class="user-card-field-label">title</span>
                <span class="user-card-field-value"><?= htmlspecialchars($data['obj']->title) ?></span>
            </div>
            <div class="user-card-field">
                <span class="user-card-field-label">author</span>
                <span class="user-card-field-value"><?= htmlspecialchars($data['obj']->author) ?></span>
            </div>
            <div class="user-card-field">
                <span class="user-card-field-label">year</span>
                <span class="user-card-field-value"><?= (int)$data['obj']->year ?> р.</span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="section-divider">
    <span class="section-divider-text">Перевірка через getInfo()</span>
</div>

<div class="info-output">
    <div class="info-output-header">Виклик getInfo() для підтвердження успішної ініціалізації</div>
    <div class="info-output-body">
        <?php foreach ($books as $data): ?>
        <div class="info-output-row">
            <span class="info-output-label"><?= $data['var'] ?></span>
            <span class="info-output-text">
                <?php 
                if (method_exists($data['obj'], 'getInfo')) {
                    echo htmlspecialchars($data['obj']->getInfo());
                } else {
                    echo "Метод getInfo() не знайдено!";
                }
                ?>
            </span>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 3', 'task3-body');