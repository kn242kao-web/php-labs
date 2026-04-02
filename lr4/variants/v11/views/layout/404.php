<div class="error-page">
    <h1 style="color: #ea580c;">404 — Тренування перервано</h1>
    <div style="font-size: 5rem; margin: 20px 0;">🏋️‍♂️</div>
    <p class="error-page__message">
        <?= htmlspecialchars($message ?? 'Схоже, ви зійшли з дистанції. Запитану сторінку або вправу не знайдено.') ?>
    </p>
    <div style="margin-top: 30px;">
        <a href="index.php?c=index&a=main" class="btn">Повернутися до залу</a>
    </div>
</div>