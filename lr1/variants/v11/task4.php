<?php

require_once __DIR__ . '/layout.php';

function getSeasonDescription(int $month): string
{
    $seasons = [
        12 => "зима", 1 => "зима", 2 => "зима",
        3 => "весна", 4 => "весна", 5 => "весна",
        6 => "літо", 7 => "літо", 8 => "літо",
        9 => "осінь", 10 => "осінь", 11 => "осінь"
    ];

    $positions = [
        12 => "початковий", 3 => "початковий", 6 => "початковий", 9 => "початковий",
        1 => "середній", 4 => "середній", 7 => "середній", 10 => "середній",
        2 => "завершальний", 5 => "завершальний", 8 => "завершальний", 11 => "завершальний"
    ];

    $season = $seasons[$month] ?? "невідомо";
    $pos = $positions[$month] ?? "невідомо";

    return "{$season}, {$pos} місяць сезону";
}

$month = 7;

$resultDescription = getSeasonDescription($month);

$monthNames = [
    1 => "Січень", 2 => "Лютий", 3 => "Березень",
    4 => "Квітень", 5 => "Травень", 6 => "Червень",
    7 => "Липень", 8 => "Серпень", 9 => "Вересень",
    10 => "Жовтень", 11 => "Листопад", 12 => "Грудень"
];

$color = "#f59e0b"; 
$emoji = "☀️";

$content = '<div class="card large">
    <div class="season-emoji">' . $emoji . '</div>
    <div class="season-month" style="color:' . $color . '">Місяць ' . $month . '</div>
    <div class="season-month-name">' . $monthNames[$month] . '</div>
    <div class="season-result" style="font-size: 1.5rem; margin-top: 10px;">' . $resultDescription . '</div>
    <p class="info" style="margin-top: 20px;">getSeasonDescription(' . $month . ') = "' . $resultDescription . '"</p>
</div>';

renderVariantLayout($content, 'Завдання 3', 'task4-body summer');