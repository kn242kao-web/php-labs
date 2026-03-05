<?php

require_once __DIR__ . '/layout.php';

function getCharCategory(string $char): string
{
    switch ($char) {

        case 'ь':
        case 'Ь':
        case "'":
            return "спеціальний символ";

        case 'а': case 'А': case 'е': case 'Е': case 'є': case 'Є':
        case 'и': case 'И': case 'і': case 'І': case 'ї': case 'Ї':
        case 'о': case 'О': case 'у': case 'У': case 'ю': case 'Ю': case 'я': case 'Я':
            return "голосна";

        default:
            return "приголосна";
    }
}

$letter = 'ь';

$result = getCharCategory($letter);

if ($result === "спеціальний символ") {
    $color = "#f59e0b"; 
    $emoji = "✨";
} elseif ($result === "голосна") {
    $color = "#10b981"; 
    $emoji = "🔊";
} else {
    $color = "#8b5cf6"; 
    $emoji = "🔇";
}

$content = '<div class="card large">
    <div class="letter-display" style="color:' . $color . '">' . $letter . '</div>
    <div class="letter-emoji" style="color:' . $color . '">' . $emoji . '</div>
    <div class="letter-result">
        Символ <strong>\'' . $letter . '\'</strong> — <span style="color:' . $color . '">' . $result . '</span>
    </div>
    <p class="info">getCharCategory(\'' . $letter . '\') = "' . $result . '"</p>
</div>';

renderVariantLayout($content, 'Завдання 4', 'task5-body');