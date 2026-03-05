<?php

require_once __DIR__ . '/layout.php';

function convertUahToEur(float $uah, float $rate): float
{
    return round($uah / $rate, 2);
}

function applyCommission(float $amount, float $commissionPercent): float
{
    return round($amount * (1 - $commissionPercent / 100), 2);
}

$uah = 48600;
$rate = 47.50;
$commission = 3;

$eurBeforeCommission = convertUahToEur($uah, $rate);
$eurAfterCommission = applyCommission($eurBeforeCommission, $commission);

$content = '<div class="card">
    <h2>💶 Конвертер UAH → EUR</h2>
    <p><strong>Курс:</strong> 1 EUR = ' . $rate . ' грн</p>
    <p><strong>Комісія банку:</strong> ' . $commission . '%</p>
    <div class="result">' . $uah . ' грн = ' . $eurBeforeCommission . ' євро</div>
    <div class="result" style="margin-top:10px;background:#d1fae5;">Після комісії ' . $commission . '% — <strong>' . $eurAfterCommission . '</strong> євро</div>
    <p class="info">convertUahToEur(' . $uah . ', ' . $rate . ') = ' . $eurBeforeCommission . '</p>
    <p class="info">applyCommission(' . $eurBeforeCommission . ', ' . $commission . ') = ' . $eurAfterCommission . '</p>
</div>';

renderVariantLayout($content, 'Завдання 2', 'task3-body');
