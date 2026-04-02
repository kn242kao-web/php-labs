<?php
$regData = $regData ?? [];
?>

<div class="success-page">
    <div class="alert alert--success">
        <h2 style="margin-bottom: 10px;">🏋️ Розрахунок/Реєстрація успішна!</h2>
        
        <p>Вітаємо у команді <strong>PowerGym</strong>, <?= htmlspecialchars($regData['login'] ?? 'атлете') ?>!</p>
        
        <p style="margin-top: 10px;">
            Ваші дані успішно оброблені. Тепер ви готові до наступного тренування з чітким планом навантажень. 
            Пам'ятайте: дисципліна — це міст між цілями та досягненнями.
        </p>
    </div>

    <div class="success-page__actions" style="margin-top: 25px; display: flex; gap: 15px; justify-content: center;">
        <a href="index.php?c=index&a=main" class="btn">На головну залу</a>
        <a href="index.php?c=regform&a=form" class="btn btn--secondary">Новий розрахунок</a>
    </div>
</div>