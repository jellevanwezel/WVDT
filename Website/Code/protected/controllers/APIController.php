<?php

class APIController extends Controller {

    public function actionLogin() {
        $message = array('status' => 'error');
        if (isset($_GET['username']) && isset($_GET['password'])) {
            $model = new LoginForm;
            $model->password = $_GET['password'];
            $model->username = $_GET['username'];
            if ($model->validate() && $model->login()) {
                $message['status'] = 'success';
                $message['sessionid'] = Yii::app()->session->id;
            }
        }
        $this->render('message', array('message' => json_encode($message)));
    }

}
