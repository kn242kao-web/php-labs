<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Обмін Валют</title>
    <style>
        /* Стилізація фону */
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Гарний градієнт */
            color: #fff;
        }

        /* Картка з ефектом скла */
        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px); /* Розмиття фону за карткою */
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
            opacity: 0.8;
        }

        .result {
            font-size: 1.8rem;
            font-weight: bold;
            line-height: 1.4;
        }

        .highlight {
            color: #00f2fe; /* Акцентний колір для цифр */
            text-shadow: 0 0 10px rgba(0, 242, 254, 0.5);
        }

        .currency-label {
            font-size: 1rem;
            opacity: 0.7;
        }
    </style>
</head>
<body>

<?php
    $sum_usd = 150;
    $rate = 39.20;
    $sum_uah = $sum_usd * $rate;
?>

<div class="glass-card">
    <h1>Курс обміну</h1>
    <div class="result">
        <span class="highlight"><?= $sum_usd ?></span> 
        <span class="currency-label">USD</span>
        <div style="margin: 10px 0; opacity: 0.5;">↓</div>
        <span class="highlight"><?= number_format($sum_uah, 2, '.', ' ') ?></span> 
        <span class="currency-label">UAH</span>
    </div>
</div>

</body>
</html>