<?php
$num = 586;

$d1 = floor($num / 100);
$d2 = floor(($num % 100) / 10);
$d3 = $num % 10;

$sum_digits = $d1 + $d2 + $d3;

$reverse = $d3 * 100 + $d2 * 10 + $d1;

$digits = [$d1, $d2, $d3];
rsort($digits);
$max_num = implode('', $digits);

echo "Число: $num<br>";
echo "1. Сума цифр: $sum_digits<br>";
echo "2. Зворотне число: $reverse<br>";
echo "3. Найбільше число: $max_num";
?>