<?php

require_once __DIR__ . '/config/init.php';

$controller = new RegformController();

$validate = new ReflectionMethod($controller, 'validate');
if (PHP_VERSION_ID < 80100) {
    $validate->setAccessible(true);
}
$tests = [
    [
        'name' => 'Ділення на нуль', 
        'data' => ['num1' => '100', 'num2' => '0', 'op' => '/', 'user_result' => '0'], 
        'expectKey' => 'num2', 
        'expectContains' => 'на нуль неможливе'
    ],
    [
        'name' => 'Від’ємне число для кореня (sqrt)', 
        'data' => ['num1' => '-25', 'num2' => '0', 'op' => 'sqrt', 'user_result' => '5'], 
        'expectKey' => 'num1', 
        'expectContains' => 'має бути більше 0'
    ],
    [
        'name' => 'Невірний результат користувача (сума)', 
        'data' => ['num1' => '50', 'num2' => '30', 'op' => '+', 'user_result' => '90'], 
        'expectKey' => 'user_result', 
        'expectContains' => 'не збігається'
    ],
    [
        'name' => 'Невірний результат користувача (множення)', 
        'data' => ['num1' => '10', 'num2' => '5', 'op' => '*', 'user_result' => '45'], 
        'expectKey' => 'user_result', 
        'expectContains' => 'не збігається'
    ],
    [
        'name' => 'Валідний розрахунок (сума)', 
        'data' => ['num1' => '100', 'num2' => '50', 'op' => '+', 'user_result' => '150'], 
        'expectEmpty' => true
    ],
    [
        'name' => 'Валідний розрахунок (степінь)', 
        'data' => ['num1' => '2', 'num2' => '3', 'op' => '^', 'user_result' => '8'], 
        'expectEmpty' => true
    ],
    [
        'name' => 'Валідний розрахунок (корінь)', 
        'data' => ['num1' => '16', 'num2' => '0', 'op' => 'sqrt', 'user_result' => '4'], 
        'expectEmpty' => true
    ],
];

$passed = 0;
$failed = 0;

echo "--- Запуск тестів валідації калькулятора PowerGym ---\n\n";

foreach ($tests as $test) {
    $errors = $validate->invoke($controller, $test['data']);

    if (!empty($test['expectEmpty'])) {
        if (empty($errors)) {
            echo "✅ PASS: {$test['name']}\n";
            $passed++;
        } else {
            echo "❌ FAIL: {$test['name']} — очікувалось відсутність помилок, але отримано: " . json_encode($errors, JSON_UNESCAPED_UNICODE) . "\n";
            $failed++;
        }
    } else {
        $key = $test['expectKey'];
        if (!isset($errors[$key])) {
            echo "❌ FAIL: {$test['name']} — очікувалась помилка для поля '{$key}', але масив порожній або ключ відсутній.\n";
            $failed++;
        } elseif (!empty($test['expectContains']) && mb_strpos($errors[$key], $test['expectContains']) === false) {
            echo "❌ FAIL: {$test['name']} — помилка має містити '{$test['expectContains']}', але отримано: '{$errors[$key]}'\n";
            $failed++;
        } else {
            echo "✅ PASS: {$test['name']}\n";
            $passed++;
        }
    }
}

$total = $passed + $failed;
echo "\nРезультат: {$passed} з {$total} тестів пройдено.\n";

if ($failed > 0) {
    exit(1);
}