<?php
class ReqviewController extends Controller {
    public function action_showrequest() {
        $this->view->render('reqview/showrequest', ['get'=>$_GET, 'post'=>$_POST]);
    }
}