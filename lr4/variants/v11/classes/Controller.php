<?php
abstract class Controller {
    protected PageView $view;
    protected Request $request;
    public function __construct() {
        $this->view = new PageView();
        $this->request = new Request();
    }
}

class PageController extends Controller {} 