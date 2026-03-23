<?php
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/Book.php';

$book1 = new Book('Тіні забутих предків', 'Михайло Коцюбинський', 1911);
$book2 = new Book('Кайдашева сім\'я', 'Іван Нечуй-Левицький', 1879);
$book3 = new Book('Захар Беркут', 'Іван Франко', 1883);

$books = [$book1, $book2, $book3];
$labels = ['$book1', '$book2', '$book3'];
$avatars = ['avatar-indigo', 'avatar-green', 'avatar-amber'];
$initials = ['Т', 'К', 'З'];

ob_start();
?>

<div class="task-header">
    <h1>Метод getInfo()</h1>
    <p>Виводить значення властивостей об'єкта <code>Book</code></p>
</div>

<div class="code-block">
<span class="code-comment">// Метод getInfo() повертає рядок з інформацією</span>
<span class="code-keyword">public function</span> <span class="code-method">getInfo</span>(): <span class="code-class">string</span>
{
    <span class="code-keyword">return</span> <span class="code-string">"Книга: {$this->title}, Автор: {$this->author}, Рік: {$this->year}"</span>;
}

<span class="code-comment">// Виклик для кожного об'єкта</span>
<span class="code-variable">$book1</span><span class="code-arrow">-></span><span class="code-method">getInfo</span>();
</div>

<div class="section-divider">
    <span class="section-divider-text">Результат виклику</span>
</div>

<div class="info-output">
    <div class="info-output-header">getInfo() — вивід для кожної книги</div>
    <div class="info-output-body">
        <?php foreach ($books as $i => $book): ?>
        <div class="info-output-row">
            <span class="info-output-label"><?= $labels[$i] ?></span>
            <span class="info-output-text"><?= htmlspecialchars($book->getInfo()) ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="section-divider">
    <span class="section-divider-text">Картки книг</span>
</div>

<div class="users-grid">
    <?php foreach ($books as $i => $book): ?>
    <div class="user-card">
        <div class="user-card-header">
            <div class="user-card-avatar <?= $avatars[$i] ?>"><?= $initials[$i] ?></div>
            <div>
                <div class="user-card-name"><?= htmlspecialchars($book->title) ?></div>
                <div class="user-card-label"><?= $labels[$i] ?>->getInfo()</div>
            </div>
        </div>
        <div class="user-card-body">
            <div class="user-card-field">
                <span class="user-card-field-label">title</span>
                <span class="user-card-field-value"><?= htmlspecialchars($book->title) ?></span>
            </div>
            <div class="user-card-field">
                <span class="user-card-field-label">author</span>
                <span class="user-card-field-value"><?= htmlspecialchars($book->author) ?></span>
            </div>
            <div class="user-card-field">
                <span class="user-card-field-label">year</span>
                <span class="user-card-field-value"><?= $book->year ?> р.</span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 2', 'task2-body');