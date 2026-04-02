<?php
class SettingsController extends Controller {
    public function action_color() {
        if ($this->request->isPost()) $_SESSION['bg_color'] = $this->request->post('color');
        $this->view->render('settings/color');
    }
    public function action_greeting() {
        if ($this->request->isPost()) {
            setcookie('user_name', $this->request->post('name'), time() + (86400 * 30), "/");
            setcookie('user_gender', $this->request->post('gender'), time() + (86400 * 30), "/");
            header("Location: index.php?c=settings&a=greeting"); exit;
        }
        $this->view->render('settings/greeting');
    }
}