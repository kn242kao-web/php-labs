<?php

require_once __DIR__ . '/layout.php';

function getCharCategory(string $char): string
{
    $char = mb_strtolower($char, 'UTF-8');

    switch ($char) {
        case 'ь':
        case "'":
            return "спеціальний символ";

        case 'а': case 'е': case 'є': case 'и': case 'і': 
        case 'ї': case 'о': case 'у': case 'ю': case 'я':
            return "голосна";

        default:
            return "приголосна";
    }
}

$char = 'ь';

$result = getCharCategory($char);

if ($result === "спеціальний symbol") {
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
    <div class="letter-display" style="color:' . $color . '">' . $char . '</div>
    <div class="letter-emoji" style="color:' . $color . '">' . $emoji . '</div>
    <div class="letter-result">
        Символ <strong>\'' . $char . '\'</strong> — <span style="color:' . $color . '">' . $result . '</span>
    </div>
    <p class="info">getCharCategory(\'' . $char . '\') = "' . $result . '"</p>
</div>';

renderVariantLayout($content, 'Завдання 4', 'task5-body');