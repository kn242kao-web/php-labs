<?php
class IndexController extends Controller {
    public function action_main() {
        $this->view->setTitle('Головна - Gym');
        $this->view->render('index/main');
    }
}