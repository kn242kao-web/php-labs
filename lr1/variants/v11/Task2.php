<?php

require_once __DIR__ . '/layout.php';

ob_start();
?>

<style>
    .poem-line {
        margin-left: 20px;
        margin-bottom: 5px;
    }
</style>

<div class="poem">
    <p class="poem-line">Мій <b>місто</b> прокидається вранці,</p>
    <p class="poem-line">Трамваї дзвенять у <i>тумані</i>,</p>
    <p class="poem-line">Вулиці повні людей і машин,</p>
    <p class="poem-line">І кожен кудись поспішає один.</p>
</div>

<?php
$content = ob_get_clean();

renderVariantLayout($content, 'Завдання 1', 'task2-body');
