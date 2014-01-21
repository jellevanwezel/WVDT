<?php

class APIController extends Controller {

    public function actionLogin() {
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            
        }
        $model = new LoginForm;
        $model->password = $_POST['password'];
        $model->username = $_POST['username'];
        if ($model->validate() && $model->login()) {
            
        }

        $this->render('index');
    }

}