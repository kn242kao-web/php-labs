<?php
class RegformController extends Controller {
    public function action_form() {
        $error = ''; $msg = '';
        if ($this->request->isPost()) {
            $n1 = (float)$this->request->post('n1');
            $n2 = (float)$this->request->post('n2');
            $op = $this->request->post('op');
            $userRes = (float)$this->request->post('result');
            $calc = 0;

            switch($op) {
                case '+': $calc = $n1 + $n2; break;
                case '-': $calc = $n1 - $n2; break;
                case '*': $calc = $n1 * $n2; break;
                case '/': if($n2==0) $error="Ділення на нуль неможливе"; else $calc=$n1/$n2; break;
                case '^': $calc = pow($n1, $n2); break;
                case 'sqrt': if($n1<0) $error="Число 1 > 0"; else $calc=sqrt($n1); break;
            }
            if(!$error) {
                if(abs($calc - $userRes) > 0.0001) $error="Результат не збігається";
                else $msg = "Розрахунок вірний: $calc";
            }
        }
        $this->view->render('regform/form', ['error'=>$error, 'msg'=>$msg]);
    }
}