<?php
/**
 * Завдання 3: Визначення сезону та позиції місяця
 */
require_once __DIR__ . '/layout.php';

$month = 7;

$monthNames = [
    1 => 'Січень', 2 => 'Лютий', 3 => 'Березень', 4 => 'Квітень',
    5 => 'Травень', 6 => 'Червень', 7 => 'Липень', 8 => 'Серпень',
    9 => 'Вересень', 10 => 'Жовтень', 11 => 'Листопад', 12 => 'Грудень'
];

function determineSeason($m) {
    if ($m == 12 || $m == 1 || $m == 2) return "Зима";
    if ($m >= 3 && $m <= 5) return "Весна";
    if ($m >= 6 && $m <= 8) return "Літо";
    if ($m >= 9 && $m <= 11) return "Осінь";
    return "Невідомо";
}

function daysInMonth($m) {
    return cal_days_in_month(CAL_GREGORIAN, $m, date('Y'));
}

$season = determineSeason($month);
$monthName = $monthNames[$month] ?? 'Невідомий';
$days = daysInMonth($month);

ob_start();
?>

<style>
    .task-container {
        text-align: center;
        font-family: "Times New Roman", serif;
        color: #000;
    }
    .month-title {
        color: #f39c12; 
        font-size: 3rem;
        margin-bottom: 0;
    }
    .month-name {
        font-size: 2rem;
        margin-top: 0;
    }
    .season-name {
        font-size: 2.5rem;
        font-weight: bold;
        margin: 20px 0;
    }
    .details {
        font-size: 1.2rem;
        line-height: 1.8;
    }
    .icon {
        width: 100px;
        margin-bottom: 10px;
    }
</style>

<div class="task-container">
    <div class="icon-placeholder">
        <img src="https://cdn-icons-png.flaticon.com/512/1053/1053862.png" alt="season-icon" class="icon">
    </div>

    <h1 class="month-title">Місяць <?= $month ?></h1>
    <h2 class="month-name"><?= $monthName ?></h2>
    
    <div class="season-name"><?= $season ?></div>

    <div class="details">
        <p>Днів у місяці: <b><?= $days ?></b></p>
        <p>determineSeason(<?= $month ?>) = "<?= $season ?>"</p>
        <p>daysInMonth(<?= $month ?>) = <?= $days ?></p>
    </div>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 3', 'task3-body');