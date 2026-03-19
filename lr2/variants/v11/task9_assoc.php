<?php
require_once __DIR__ . '/layout.php';

function sortByStudentName(array $students): array
{
    ksort($students);
    return $students;
}
function sortByGrade(array $students): array
{
    asort($students);
    return $students;
}

$students = [
    "Бондаренко Олег" => 10,
    "Гнатюк Марія" => 7,
    "Дорошенко Артем" => 12,
    "Коваленко Софія" => 5,
    "Мельник Данило" => 9,
    "Петренко Анна" => 11,
    "Ткачук Ігор" => 3,
];
$sortBy = $_POST['sort'] ?? 'name';
$sorted = ($sortBy === 'grade') ? sortByGrade($students) : sortByStudentName($students);

ob_start();
?>
<div class="demo-card">
    <h2>Асоціативний масив: Студенти</h2>
    <p class="demo-subtitle">Сортування списку за прізвищем або успішністю</p>

    <div class="flex-buttons" style="display: flex; gap: 10px; margin-bottom: 20px;">
        <form method="post">
            <input type="hidden" name="sort" value="name">
            <button type="submit" class="<?= $sortBy === 'name' ? 'btn-submit' : 'btn-secondary' ?>">
                За прізвищем (ksort)
            </button>
        </form>
        <form method="post">
            <input type="hidden" name="sort" value="grade">
            <button type="submit" class="<?= $sortBy === 'grade' ? 'btn-submit' : 'btn-secondary' ?>">
                За оцінкою (asort)
            </button>
        </form>
    </div>

    <div class="demo-section">
        <h3>Поточний список: <span class="demo-tag demo-tag-primary"><?= $sortBy === 'grade' ? 'за оцінкою' : 'за алфавітом' ?></span></h3>
        <table class="demo-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ПІБ студента <?= $sortBy === 'name' ? '&#8595;' : '' ?></th>
                    <th>Оцінка <?= $sortBy === 'grade' ? '&#8593;' : '' ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($sorted as $name => $grade): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($name) ?></td>
                    <td>
                        <span class="demo-tag <?= $grade >= 10 ? 'demo-tag-success' : ($grade <= 3 ? 'demo-tag-primary' : '') ?>">
                            <?= $grade ?> балів
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="demo-code">
// Використана функція: <?= $sortBy === 'grade' ? 'asort($students)' : 'ksort($students)' ?> 
// Вхідний масив містить <?= count($students) ?> записів.
    </div>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 9');