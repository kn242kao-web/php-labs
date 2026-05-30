<?php

class AuthController extends PageController
{
    private PDO $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getInstance();
    }

    public function action_register(): void
    {
        if ($this->isAuthenticated()) {
            $this->redirect('auth/profile');
            return;
        }

        $errors = [];
        $old = [];

        if ($this->request->isPost()) {
            $old = $this->request->allPost();
            $errors = $this->validateRegister($old);

            if (empty($errors)) {
                $stmt = $this->db->prepare(
                    'INSERT INTO users (login, password, email, first_name, last_name, phone, city, gender, about, created_at)
                     VALUES (:login, :password, :email, :first_name, :last_name, :phone, :city, :gender, :about, DATETIME("now"))'
                );
                
                $stmt->execute([
                    ':login'      => trim($old['login']),
                    ':password'   => password_hash($old['password'], PASSWORD_DEFAULT), 
                    ':email'      => trim($old['email']),
                    ':first_name' => trim($old['first_name']),
                    ':last_name'  => trim($old['last_name']),
                    ':phone'      => trim($old['phone'] ?? ''),
                    ':city'       => trim($old['city'] ?? ''),
                    ':gender'     => $old['gender'] ?? '',
                    ':about'      => trim($old['about'] ?? ''),
                ]);

                session_regenerate_id(true);
                $_SESSION['user_id'] = $this->db->lastInsertId();
                $_SESSION['user_login'] = trim($old['login']);
                
                $this->redirect('auth/profile');
                return;
            }
        }

        $this->render('auth/register', [
            'errors' => $errors,
            'old'    => $old,
        ], 'Реєстрація атлета');
    }

    public function action_login(): void
    {
        if ($this->isAuthenticated()) {
            $this->redirect('auth/profile');
            return;
        }

        $error = '';

        if ($this->request->isPost()) {
            $login = trim($this->request->post('login', ''));
            $password = $this->request->post('password', '');

            $stmt = $this->db->prepare('SELECT * FROM users WHERE login = :login');
            $stmt->execute([':login' => $login]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_login'] = $user['login'];
                $this->redirect('auth/profile');
                return;
            }

            $error = 'Невірний логін або пароль.';
        }

        $this->render('auth/login', ['error' => $error], 'Вхід до залу');
    }

    public function action_profile(): void
    {
        if (!$this->isAuthenticated()) {
            $this->redirect('auth/login');
            return;
        }

        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $_SESSION['user_id']]);
        $user = $stmt->fetch();

        $this->render('auth/profile', ['user' => $user], 'Мій профіль');
    }

    public function action_edit(): void
    {
        if (!$this->isAuthenticated()) {
            $this->redirect('auth/login');
            return;
        }

        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $_SESSION['user_id']]);
        $user = $stmt->fetch();

        $errors = [];

        if ($this->request->isPost()) {
            $data = $this->request->allPost();
            $errors = $this->validateEdit($data);

            if (empty($errors)) {
                $stmt = $this->db->prepare(
                    'UPDATE users SET email = :email, first_name = :first_name, last_name = :last_name,
                     phone = :phone, city = :city, gender = :gender, about = :about WHERE id = :id'
                );
                $stmt->execute([
                    ':email'      => trim($data['email']),
                    ':first_name' => trim($data['first_name']),
                    ':last_name'  => trim($data['last_name']),
                    ':phone'      => trim($data['phone'] ?? ''),
                    ':city'       => trim($data['city'] ?? ''),
                    ':gender'     => $data['gender'] ?? '',
                    ':about'      => trim($data['about'] ?? ''),
                    ':id'         => $_SESSION['user_id'],
                ]);

                $this->redirect('auth/profile');
                return;
            }
            $user = array_merge($user, $data);
        }

        $this->render('auth/edit', ['user' => $user, 'errors' => $errors], 'Редагування профілю');
    }

    public function action_logout(): void
    {
        unset($_SESSION['user_id'], $_SESSION['user_login']);
        session_destroy();
        $this->redirect('index/main');
    }

    public function action_delete(): void
    {
        if (!$this->isAuthenticated()) {
            $this->redirect('auth/login');
            return;
        }

        if ($this->request->isPost() && $this->request->post('confirm') === 'yes') {
            $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
            $stmt->execute([':id' => $_SESSION['user_id']]);
            
            $this->action_logout();
            return;
        }

        $this->render('auth/delete', [], 'Видалення акаунту');
    }

    private function validateRegister(array $data): array
    {
        $errors = [];
        $login = trim($data['login'] ?? '');
        
        if (strlen($login) < 3) {
            $errors['login'] = 'Логін занадто короткий.';
        } else {
            $stmt = $this->db->prepare('SELECT id FROM users WHERE login = :login');
            $stmt->execute([':login' => $login]);
            if ($stmt->fetch()) $errors['login'] = 'Цей логін вже зайнятий.';
        }

        if (strlen($data['password'] ?? '') < 6) {
            $errors['password'] = 'Пароль від 6 символів.';
        }

        if (!filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Некоректний E-mail.';
        }

        if (empty($data['first_name'])) $errors['first_name'] = "Вкажіть ім'я.";
        
        return $errors;
    }

    private function validateEdit(array $data): array
    {
        $errors = [];
        if (!filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Некоректний E-mail.';
        }
        return $errors;
    }
}