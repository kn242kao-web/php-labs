<?php
session_start();
require_once __DIR__ . '/layout.php';
$languages = [
    'uk' => '🇺🇦 Укр',
    'en' => '🇬🇧 En',
    'pl' => '🇵🇱 Pl',
];

if (isset($_GET['lang']) && isset($languages[$_GET['lang']])) {
    $lang = $_GET['lang'];
    setcookie('lang', $lang, time() + 180 * 24 * 3600, '/');
} else {
    $lang = $_COOKIE['lang'] ?? 'uk';
}
$cities = ['Київ', 'Львів', 'Одеса', 'Харків', 'Дніпро', 'Запоріжжя', 'Вінниця', 'Полтава', 'Чернігів', 'Тернопіль'];
$hobbies = [
    'coding' => 'Програмування',
    'gym' => 'Спортзал',
    'gaming' => 'Ігри',
    'photo' => 'Фотографія'
];

$sessionData = $_SESSION['user_reg'] ?? [];
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $pass = $_POST['pass'] ?? '';
    $pass2 = $_POST['pass2'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $city = $_POST['city'] ?? '';
    $userHobbies = $_POST['hobbies'] ?? [];
    $about = trim($_POST['about'] ?? '');
    if (empty($login)) {
        $errors[] = 'Логін обов’язковий';
    }
    if (strlen($pass) < 4) {
        $errors[] = 'Пароль занадто короткий (мін. 4 символи)';
    }
    
    if ($pass !== $pass2) {
        $errors[] = 'Паролі не збігаються';
    }
    
    if (empty($gender)) {
        $errors[] = 'Оберіть стать';
    }
    
    if (empty($city)) {
        $errors[] = 'Оберіть місто';
    }
    $photoPath = $sessionData['photo'] ?? '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid('user_') . '.' . $ext;
        $dir = __DIR__ . '/uploads/';
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $dir . $fileName)) {
            $photoPath = 'uploads/' . $fileName;
        }
    }
    $_SESSION['user_reg'] = [
        'login' => $login,
        'gender' => $gender,
        'city' => $city,
        'hobbies' => $userHobbies,
        'about' => $about,
        'photo' => $photoPath
    ];

    if (empty($errors)) {
        $success = true;
    }
}
$val = [
    'login' => $_POST['login'] ?? $sessionData['login'] ?? 'oleg_bond11',
    'gender' => $_POST['gender'] ?? $sessionData['gender'] ?? '',
    'city' => $_POST['city'] ?? $sessionData['city'] ?? '',
    'hobbies' => $_POST['hobbies'] ?? $sessionData['hobbies'] ?? [],
    'about' => $_POST['about'] ?? $sessionData['about'] ?? '',
];

ob_start();
?>
<div class="demo-card demo-card-wide">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Реєстрація: <?= htmlspecialchars($val['login']) ?></h2>
        <div class="lang-icons">
            <?php foreach ($languages as $code => $label): ?>
                <a href="?lang=<?= $code ?>" style="text-decoration:none; margin-left:10px; <?= $lang===$code ? 'font-weight:bold; border-bottom:2px solid blue;' : 'opacity:0.5' ?>">
                    <?= $label ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="demo-result demo-result-error" style="background: #fee; border-left: 4px solid #f44; padding: 10px; margin-bottom: 20px;">
            <ul style="margin: 0;"><?php foreach ($errors as $e): ?><li><?= $e ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="demo-result demo-result-success" style="background: #efe; border-left: 4px solid #4caf50; padding: 10px; margin-bottom: 20px;">
            <strong>Успіх!</strong> Дані збережено в сесії.
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="demo-form">
        <div class="form-group" style="margin-bottom: 15px;">
            <label style="display:block;">Логін:</label>
            <input type="text" name="login" value="<?= htmlspecialchars($val['login']) ?>" style="width:100%; padding:8px;">
        </div>

        <div style="display: flex; gap: 15px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label style="display:block;">Пароль:</label>
                <input type="password" name="pass" style="width:100%; padding:8px;">
            </div>
            <div style="flex: 1;">
                <label style="display:block;">Повтор:</label>
                <input type="password" name="pass2" style="width:100%; padding:8px;">
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Стать:</label><br>
            <input type="radio" name="gender" value="male" <?= $val['gender']=='male'?'checked':'' ?>> Чоловік
            <input type="radio" name="gender" value="female" <?= $val['gender']=='female'?'checked':'' ?>> Жінка
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label style="display:block;">Місто:</label>
            <select name="city" style="width:100%; padding:8px;">
                <option value="">-- Оберіть місто --</option>
                <?php foreach ($cities as $c): ?>
                    <option value="<?= $c ?>" <?= $val['city']==$c?'selected':'' ?>><?= $c ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Хобі:</label><br>
            <?php foreach ($hobbies as $k => $l): ?>
                <label style="margin-right: 10px;">
                    <input type="checkbox" name="hobbies[]" value="<?= $k ?>" <?= in_array($k, $val['hobbies'])?'checked':'' ?>> <?= $l ?>
                </label>
            <?php endforeach; ?>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label style="display:block;">Про себе:</label>
            <textarea name="about" rows="3" style="width:100%; padding:8px;"><?= htmlspecialchars($val['about']) ?></textarea>
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label style="display:block;">Фото профілю:</label>
            <input type="file" name="photo">
            <?php if (!empty($sessionData['photo'])): ?>
                <div style="margin-top:10px; color: green; font-size: 0.9em;">✓ Фото завантажено</div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn-submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer;">
            Відправити дані
        </button>
    </form>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 10');