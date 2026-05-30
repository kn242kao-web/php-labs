<?php
require_once __DIR__ . '/layout.php';

function convertUsdToUah(float $usd, float $rate): int
{
    return (int) floor($usd * $rate);
}

function formatConversionResult(float $usd, int $uah): string
{
    return "{$usd} долар = {$uah} грн";
}

$usd = 100;
$rate = 41.50;

$uah = convertUsdToUah($usd, $rate);
$result = formatConversionResult($usd, $uah);

$content = '<div class="card">
    <h2>💵 Конвертер USD → UAH</h2>
    <p><strong>Курс:</strong> 1 USD = ' . $rate . ' грн</p>
    <div class="result">' . $result . '</div>
    <p class="info">Функція: convertUsdToUah(' . $usd . ', ' . $rate . ') = ' . $uah . '</p>
</div>';

renderDemoLayout($content, 'Завдання 3', 'task3-body');
