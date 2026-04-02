<div class="page-home">
    <h1>PowerGym — Твій шлях до сили</h1>
    <p class="page-home__subtitle">Ласкаво просимо до нашого сучасного тренажерного залу! Ми пропонуємо професійне обладнання, індивідуальні програми тренувань та комфортні умови для досягнення ваших цілей.</p>

    <div class="card-grid">
        <div class="card">
            <h3 class="card__title">Наші послуги</h3>
            <p class="card__text">
                Силові тренування, кардіо-зона, кросфіт та йога. 
                Наші тренери допоможуть скласти план, який працює саме для вас.
            </p>
            <ul style="font-size: 0.9rem; color: #6b7280; margin-left: 15px;">
                <li>Пн-Пт: 07:00 — 23:00</li>
                <li>Сб-Нд: 09:00 — 21:00</li>
            </ul>
        </div>

        <div class="card">
            <h3 class="card__title">Калькулятор навантажень</h3>
            <p class="card__text">
                Скористайтеся нашим розумним калькулятором, щоб розрахувати вагу, 
                кількість підходів та інтенсивність вашого наступного тренування.
            </p>
            <a href="index.php?c=regform&a=form" class="btn btn--small">Розрахувати</a>
        </div>

        <div class="card">
            <h3 class="card__title">Параметри запиту</h3>
            <p class="card__text">
                Технічна сторінка для перегляду GET та POST параметрів. 
                Використовується для налагодження роботи системи MVC.
            </p>
            <a href="index.php?c=reqview&a=showrequest" class="btn btn--small">Переглянути</a>
        </div>

        <div class="card">
            <h3 class="card__title">Мій профіль</h3>
            <p class="card__text">
                Персоналізуйте свій досвід: оберіть колір фону сайту та 
                налаштуйте іменне привітання для мотивації.
            </p>
            <a href="index.php?c=settings&a=color" class="btn btn--small">Налаштувати</a>
        </div>
    </div>

    <div class="info-block">
        <h2>Архітектура системи Gym MVC</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Клас системи</th>
                    <th>Призначення в проекті Gym</th>
                </tr>
            </thead>
            <tbody>
                <tr><td><code>Application</code></td><td>Ініціалізація системи та запуск життєвого циклу додатка</td></tr>
                <tr><td><code>Router</code></td><td>Аналіз URL-запиту та маршрутизація до потрібного тренера (контролера)</td></tr>
                <tr><td><code>Request</code></td><td>Безпечне отримання даних з форм та перевірка параметрів запиту</td></tr>
                <tr><td><code>Controller</code></td><td>Базовий клас, що забезпечує зв'язок між даними та відображенням</td></tr>
                <tr><td><code>PageController</code></td><td>Спеціалізований контролер для управління текстовим контентом сторінок</td></tr>
                <tr><td><code>View</code></td><td>Клас для рендерингу окремих частин інтерфейсу</td></tr>
                <tr><td><code>PageView</code></td><td>Формування цілісної сторінки з урахуванням сесій та налаштувань користувача</td></tr>
            </tbody>
        </table>
    </div>
</div>