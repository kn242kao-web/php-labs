<?php
require_once __DIR__ . '/layout.php';

function determineSeason(int $month): string
{
    if ($month >= 3 && $month <= 5) {
        return "Весна";
    } elseif ($month >= 6 && $month <= 8) {
        return "Літо";
    } elseif ($month >= 9 && $month <= 11) {
        return "Осінь";
    } else {
        return "Зима";
    }
}

$month = 7;

$season = determineSeason($month);

$monthNames = [
    1 => "Січень", 2 => "Лютий", 3 => "Березень",
    4 => "Квітень", 5 => "Травень", 6 => "Червень",
    7 => "Липень", 8 => "Серпень", 9 => "Вересень",
    10 => "Жовтень", 11 => "Листопад", 12 => "Грудень"
];

$styles = [
    "Весна" => ["class" => "spring", "color" => "#10b981", "emoji" => "🌸"],
    "Літо" => ["class" => "summer", "color" => "#f59e0b", "emoji" => "☀️"],
    "Осінь" => ["class" => "autumn", "color" => "#f97316", "emoji" => "🍂"],
    "Зима" => ["class" => "winter", "color" => "#3b82f6", "emoji" => "❄️"],
];

$style = $styles[$season];

$content = '<div class="card large">
    <div class="season-emoji">' . $style['emoji'] . '</div>
    <div class="season-month" style="color:' . $style['color'] . '">Місяць ' . $month . '</div>
    <div class="season-month-name">' . $monthNames[$month] . '</div>
    <div class="season-result">' . $season . '</div>
    <p class="info">Функція: determineSeason(' . $month . ') = "' . $season . '"</p>
</div>';

renderDemoLayout($content, 'Завдання 4', 'task4-body ' . $style['class']);
