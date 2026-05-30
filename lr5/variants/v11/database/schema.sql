
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    login VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(20) DEFAULT '',
    city VARCHAR(50) DEFAULT '',
    gender VARCHAR(10) DEFAULT '', 
    about TEXT DEFAULT '',         
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS trainings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(150) NOT NULL,        
    trainer_name VARCHAR(100) NOT NULL, 
    training_date DATETIME NOT NULL,    
    duration_min INTEGER DEFAULT 60,    
    capacity INTEGER DEFAULT 10,        
    description TEXT DEFAULT '',       
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO trainings (title, trainer_name, training_date, duration_min, capacity, description) VALUES
    ('Crossfit Intensive', 'Олександр Титан', '2026-04-10 10:00:00', 60, 12, 'Високоінтенсивне тренування для розвитку витривалості та сили. Рівень: середній.'),
    ('Yoga Flow', 'Марія Дзен', '2026-04-10 12:00:00', 90, 15, 'Ранкова йога для гнучкості та балансу. При собі мати килимок.'),
    ('Power Lifting', 'Дмитро Штанга', '2026-04-11 18:00:00', 60, 8, 'Базові вправи: присідання, жим лежачи, станова тяга. Тільки для досвідчених атлетів.'),
    ('Zumba Dance', 'Олена Ритм', '2026-04-11 19:30:00', 45, 20, 'Танцювальний фітнес під запальні латиноамериканські ритми. Спалюємо калорії весело!'),
    ('Boxing Basics', 'Віктор Боксер', '2026-04-12 11:00:00', 75, 10, 'Відпрацювання техніки ударів та координації. Рукавички надаються залом.'),
    ('Pilates Med', 'Анна Гнучка', '2026-04-12 17:00:00', 60, 12, 'Зміцнення м’язів кору та корекція постави. Рекомендовано для відновлення.'),
    ('TRX Training', 'Сергій Петлі', '2026-04-13 09:00:00', 45, 10, 'Функціональний тренінг з використанням підвісних систем TRX.'),
    ('Body Pump', 'Ігор Сталь', '2026-04-13 18:30:00', 60, 25, 'Силове тренування з низькою вагою та високою кількістю повторень під музику.'),
    ('Cycling Race', 'Наталя Спін', '2026-04-14 08:15:00', 50, 15, 'Кардіо-тренування на стаціонарних велосипедах. Імітація їзди по пересіченій місцевості.'),
    ('Stretch & Relax', 'Марія Дзен', '2026-04-14 20:00:00', 40, 20, 'Заняття на розслаблення м’язів після важкого робочого дня.');