<?php

class GalleryController extends PageController 
{
    private string $uploadDir = 'uploads/gallery';

    public function action_main(): void 
    {
        $this->action_index();
    }

    public function action_index(): void 
    {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = $_FILES['image']['name'];
                $fileSize = $_FILES['image']['size'];
                
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array($fileExtension, $allowedExtensions)) {
                    if ($fileSize <= 5242880) {
                        if (!is_dir($this->uploadDir)) {
                            mkdir($this->uploadDir, 0777, true);
                        }

                        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                        $dest_path = $this->uploadDir . '/' . $newFileName;

                        if (move_uploaded_file($fileTmpPath, $dest_path)) {
                            $_SESSION['flash_success'] = "Фотографію успішно додано у стрічку!";
                            header("Location: index.php?route=gallery");
                            exit;
                        } else {
                            $error = "Не вдалося зберегти файл.";
                        }
                    } else {
                        $error = "Файл занадто великий! Максимальний розмір — 5 МБ.";
                    }
                } else {
                    $error = "Недопустимий формат файлу!";
                }
            } else {
                $error = "Помилка завантаження файлу.";
            }
        }

        if (isset($_SESSION['flash_success'])) {
            $success = $_SESSION['flash_success'];
            unset($_SESSION['flash_success']);
        }

        // Зчитуємо наявні файли
        $photos = [];
        if (is_dir($this->uploadDir)) {
            $files = scandir($this->uploadDir);
            foreach ($files as $file) {
                if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $photos[] = $this->uploadDir . '/' . $file;
                }
            }
            rsort($photos);
        }

        $this->render('dish/gallery', [
            'photos'  => $photos,
            'error'   => $error,
            'success' => $success
        ], 'Галерея залу');
    }

    public function action_delete(): void 
    {
        $file = $_GET['file'] ?? '';

        if (!empty($file)) {
            $file = basename($file);
            $fullPath = $this->uploadDir . '/' . $file;

            if (file_exists($fullPath)) {
                unlink($fullPath);
                $_SESSION['flash_success'] = "Фотографію успішно видалено зі стрічки!";
            }
        }

        header("Location: index.php?route=gallery");
        exit;
    }
}