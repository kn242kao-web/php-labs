<?php

class FolderController extends PageController {
    
    public function action_create(): void {
        $message = ''; 
        $error = '';
        
        if ($this->request->isPost()) {
            $login = preg_replace('/[^a-z0-9_]/i', '', $_POST['login'] ?? '');
            $path = DATA_DIR . "/users/$login";

            if (empty($login)) {
                $error = "Логін не може бути порожнім!";
            } elseif (is_dir($path)) {
                $error = "Атлет з таким логіном вже має каталог!";
            } else {
                mkdir($path, 0777, true);
                foreach (['video', 'music', 'photo'] as $sub) {
                    mkdir("$path/$sub", 0777, true);
                    file_put_contents("$path/$sub/info.txt", "Каталог $sub для $login");
                }
                $message = "Каталог для $login успішно створено!";
            }
        }
        $this->render('folder/create', ['message' => $message, 'error' => $error], 'Робота з каталогами');
    }

    public function action_delete(): void {
        if ($this->request->isPost()) {
            $login = preg_replace('/[^a-z0-9_]/i', '', $_POST['login'] ?? '');
            $path = DATA_DIR . "/users/$login";
            if (!empty($login) && is_dir($path)) {
                $this->rrmdir($path); 
                $this->redirect('folder', 'create');
                return;
            }
        }
        $this->render('folder/delete', [], 'Видалення каталогу');
    }

    private function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir."/".$object)) {
                        $this->rrmdir($dir."/".$object);
                    } else {
                        unlink($dir."/".$object);
                    }
                }
            }
            rmdir($dir);
        }
    }
}