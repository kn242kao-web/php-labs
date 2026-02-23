<?php
$char = 'ь';

switch (true) {
    case ($char === 'ь' || $char === "'"):
        $type = "спеціальний символ";
        break;
    case (preg_match('/[аеєиіїоуюя]/u', mb_strtolower($char))):
        $type = "голосна";
        break;
    default:
        $type = "приголосна";
}

echo "Символ '$char' — це $type";
?>