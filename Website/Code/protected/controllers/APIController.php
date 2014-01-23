<?php

class APIController extends Controller {

    public function actionLogin() {
        $message = array('status' => 'success');
        if (!isset($_GET['username']) || !isset($_GET['password'])) {
            throw new JException('Invalid username/password.');
        }

        $model = new LoginForm;
        $model->password = $_GET['password'];
        $model->username = $_GET['username'];
        if (!$model->validate() || !$model->login()) {
            throw new JException('Failed to login.');
        }
        
        $message['sessionid'] = Yii::app()->session->getSessionID();

        $this->renderPartial('message', array('message' => json_encode($message)));
    }

    public function actionGetList() {
        $message = array('status' => 'success');

        $productList = ProductUser::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
        if ($productList == null) {
            throw new JException('No products found.');
        }

        $products = array();
        $i = 0;
        foreach ($productList as $productUser) {
            $products[$i]['id'] = $productUser->id;
            $products[$i]['user_id'] = $productUser->user_id;
            $products[$i]['product_id'] = $productUser->product_id;
            $products[$i]['amount'] = $productUser->amount;
            $products[$i]['amount_scanned'] = $productUser->amount_scanned;
            $i ++;
        }
        $message['products'] = $products;

        $this->renderPartial('message', array('message' => json_encode($message)));
    }

    public function actionSetProduct() {
        $message = array('status' => 'success');

        if (!isset($_GET['pid']) || !is_numeric($_GET['pid']) || !isset($_GET['amount']) || !is_numeric($_GET['amount'])) {
            throw new JException('Invalid product id or amount.');
        }

        $productUser = ProductUser::model()->findByAttributes(array('id' => $_GET['pid']));
        if ($productUser == null) {
            throw new JException('Invalid product id.');
        }
        $productUser->amount_scanned = $_GET['amount'];

        if (!$productUser->save()) {
            throw new JException('Failed to update the product.');
        }

        $this->renderPartial('message', array('message' => json_encode($message)));
    }

}
