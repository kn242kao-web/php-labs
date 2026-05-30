<?php

class TrainingsController extends PageController 
{
    private ?PDO $localDb = null;

    public function __construct()
    {
        parent::__construct();
        
        if (isset($this->db) && $this->db instanceof PDO) {
            $this->localDb = $this->db;
        } elseif (defined('DB_DSN') || defined('DB_HOST')) {
            try {
                $dsn = defined('DB_DSN') ? DB_DSN : "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
                $user = defined('DB_USER') ? DB_USER : '';
                $pass = defined('DB_PASS') ? DB_PASS : '';
                
                $this->localDb = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                $this->localDb = null;
            }
        }
    }

    public function action_main(): void 
    {
        $this->action_list();
    }

    public function action_list(): void 
    {
        $trainings = [];
        if ($this->localDb !== null) {
            try {
                $stmt = $this->localDb->query("SELECT id, title, trainer_name, training_date, duration_min, capacity FROM trainings ORDER BY training_date ASC");
                $trainings = $stmt->fetchAll();
            } catch (PDOException $e) {
            }
        }

        $this->render('recipe/list', [
            'trainings' => $trainings
        ], 'Розклад тренувань');
    }
    public function action_create(): void 
    {
        $error = '';

        if ($this->request->isPost()) {
            $title = trim($_POST['title'] ?? '');
            $trainer_name = trim($_POST['trainer_name'] ?? '');
            $training_date = trim($_POST['training_date'] ?? '');
            $duration_min = (int)($_POST['duration_min'] ?? 0);
            $capacity = (int)($_POST['capacity'] ?? 0);

            if ($title && $trainer_name && $training_date && $duration_min && $capacity) {
                if ($this->localDb !== null) {
                    try {
                        $sql = "INSERT INTO trainings (title, trainer_name, training_date, duration_min, capacity) 
                                VALUES (:title, :trainer_name, :training_date, :duration_min, :capacity)";
                        $stmt = $this->localDb->prepare($sql);
                        $stmt->execute([
                            ':title' => $title,
                            ':trainer_name' => $trainer_name,
                            ':training_date' => $training_date,
                            ':duration_min' => $duration_min,
                            ':capacity' => $capacity
                        ]);

                        $_SESSION['flash_success'] = "Тренування успішно додано до розкладу!";
                        header("Location: index.php?route=trainings/list");
                        exit;
                    } catch (PDOException $e) {
                        $error = "Помилка бази даних: " . $e->getMessage();
                    }
                }
            } else {
                $error = "Будь ласка, заповніть усі поля форми!";
            }
        }

        $this->render('recipe/create', [
            'error' => $error
        ], 'Додати тренування');
    }

    public function action_edit(): void 
    {
        $id = (int)($_GET['id'] ?? 0);
        $error = '';
        $training = null;

        if ($this->localDb !== null && $id > 0) {
            $stmt = $this->localDb->prepare("SELECT * FROM trainings WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $training = $stmt->fetch();
        }

        if (!$training) {
            header("Location: index.php?route=trainings/list");
            exit;
        }

        if ($this->request->isPost()) {
            $title = trim($_POST['title'] ?? '');
            $trainer_name = trim($_POST['trainer_name'] ?? '');
            $training_date = trim($_POST['training_date'] ?? '');
            $duration_min = (int)($_POST['duration_min'] ?? 0);
            $capacity = (int)($_POST['capacity'] ?? 0);

            if ($title && $trainer_name && $training_date && $duration_min && $capacity) {
                try {
                    $sql = "UPDATE trainings SET title = :title, trainer_name = :trainer_name, 
                            training_date = :training_date, duration_min = :duration_min, capacity = :capacity 
                            WHERE id = :id";
                    $stmt = $this->localDb->prepare($sql);
                    $stmt->execute([
                        ':title' => $title,
                        ':trainer_name' => $trainer_name,
                        ':training_date' => $training_date,
                        ':duration_min' => $duration_min,
                        ':capacity' => $capacity,
                        ':id' => $id
                    ]);

                    $_SESSION['flash_success'] = "Зміни збережено!";
                    header("Location: index.php?route=trainings/list");
                    exit;
                } catch (PDOException $e) {
                    $error = "Помилка оновлення: " . $e->getMessage();
                }
            } else {
                $error = "Всі поля мають бути заповнені!";
            }
        }

        $this->render('recipe/edit', [
            'training' => $training,
            'error' => $error
        ], 'Редагувати тренування');
    }
    public function action_delete(): void 
    {
        $id = (int)($_GET['id'] ?? 0);

        if ($this->localDb !== null && $id > 0) {
            try {
                $stmt = $this->localDb->prepare("DELETE FROM trainings WHERE id = :id");
                $stmt->execute([':id' => $id]);
                $_SESSION['flash_success'] = "Тренування видалено!";
            } catch (PDOException $e) {
            }
        }

        header("Location: index.php?route=trainings/list");
        exit;
    }
}