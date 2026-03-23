<?php
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/Book.php';

$book1 = new Book('Тіні забутих предків', 'Михайло Коцюбинський', 1911);
$book2 = new Book('Кайдашева сім\'я', 'Іван Нечуй-Левицький', 1879);
$book3 = new Book('Захар Беркут', 'Іван Франко', 1883);

$books = [
    ['obj' => $book1, 'avatar' => 'avatar-indigo', 'initial' => 'Т'],
    ['obj' => $book2, 'avatar' => 'avatar-green', 'initial' => 'К'],
    ['obj' => $book3, 'avatar' => 'avatar-amber', 'initial' => 'З'],
];

ob_start();
?>

<div class="task-header">
    <h1>Створення об'єктів</h1>
    <p>Клас <code>Book</code> з властивостями: title, author, year</p>
</div>

<div class="code-block">
    <span class="code-comment">// Створюємо об'єкт та задаємо властивості</span>
    <span class="code-variable">$book1</span> = <span class="code-keyword">new</span> <span class="code-class">Book</span>();
    <span class="code-variable">$book1</span><span class="code-arrow">-></span><span class="code-method">title</span> = <span class="code-string">'Тіні забутих предків'</span>;
    <span class="code-variable">$book1</span><span class="code-arrow">-></span><span class="code-method">author</span> = <span class="code-string">'Михайло Коцюбинський'</span>;
    <span class="code-variable">$book1</span><span class="code-arrow">-></span><span class="code-method">year</span> = <span class="code-number">1911</span>;
</div>

<div class="section-divider">
    <span class="section-divider-text">3 ОБ'ЄКТИ</span>
</div>

<div class="users-grid">
    <?php foreach ($books as $i => $data): ?>
    <div class="user-card">
        <div class="user-card-header">
            <div class="user-card-avatar <?= $data['avatar'] ?>"><?= $data['initial'] ?></div>
            <div>
                <div class="user-card-name"><?= htmlspecialchars($data['obj']->title) ?></div>
                <div class="user-card-label">Об'єкт #<?= $i + 1 ?></div>
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
                <span class="user-card-field-value"><?= $data['obj']->year ?> р.</span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 1', 'task1-body');