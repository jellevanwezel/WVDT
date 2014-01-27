<?php

class APIController extends Controller {

    public $defaultAction = 'login';

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
        if (Yii::app()->user->isGuest) {
            throw new JException('No session found.');
        }
        $message = array('status' => 'success');

        $productList = ProductUser::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
        if ($productList == null) {
            throw new JException('List empty');
        }

        $products = array();
        $i = 0;
        foreach ($productList as $productUser) {
            $products[$i]['id'] = $productUser->id;
            $products[$i]['amount'] = $productUser->amount;
            $products[$i]['amount_scanned'] = $productUser->amount_scanned;
            $products[$i]['qr_code'] = $productUser->product->qr_code;
            $products[$i]['price'] = $productUser->product->price;
            $products[$i]['name'] = $productUser->product->name;
            $i ++;
        }
        $message['products'] = $products;

        $this->renderPartial('message', array('message' => json_encode($message)));
    }

    public function actionSetProduct() {
        if (Yii::app()->user->isGuest) {
            throw new JException('No session found.');
        }
        $message = array('status' => 'success');

        if (!isset($_GET['qr'])) {
            throw new JException('Invalid qr code.');
        }

        $product = Product::model()->findByAttributes(array('qr_code' => $_GET['qr']));
        if ($product == null) {
            throw new JException('Product not found.');
        }
        
        $productUser = ProductUser::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'product_id' => $product->id));
        if ($productUser == null) {
            $productUser = new ProductUser();
            $productUser->user_id = Yii::app()->user->id;
            $productUser->product_id = $product->id;
            $productUser->amount = 0;
            $productUser->amount_scanned = 1;
        }else {
            $productUser->amount_scanned ++;
        }

        if (!$productUser->save()) {
            throw new JException('Failed to update the product.');
        }

        $this->renderPartial('message', array('message' => json_encode($message)));
    }

    //TODO: Refactor
    public function actionPay() {
        if (Yii::app()->user->isGuest) {
            throw new JException('No session found.');
        }

        $message = array('status' => 'success');

        $productList = ProductUser::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
        if ($productList == null) {
            throw new JException('Productlist empty.');
        }

        $transaction = Yii::app()->db->beginTransaction();
        $payment = new Payment();
        $payment->user_id = Yii::app()->user->id;
        $payment->created_at = new CDbExpression('NOW()');
        if (!$payment->save()) {
            $transaction->rollback();
            throw new JException('Updating failed.');
        }

        $productsScanned = 0;
        foreach ($productList as $productUser) {
            if ($productUser->amount_scanned > 0) {
                $productPayment = new ProductPayment();
                $productPayment->payment_id = $payment->id;
                $productPayment->product_id = $productUser->product_id;
                $productPayment->amount = $productUser->amount_scanned;

                if (!$productPayment->save()) {
                    $transaction->rollback();
                    throw new JException('Updating failed.');
                }

                $productsScanned ++;
            }

            if (!$productUser->delete()) {
                $transaction->rollback();
                throw new JException('Updating failed.');
            }
        }

        if ($productsScanned == 0) {
            $transaction->rollback();
            throw new JException('No products scanned.');
        }

        $transaction->commit();

        $message['paymentid'] = $payment->id;

        $this->renderPartial('message', array('message' => json_encode($message)));
    }

}
