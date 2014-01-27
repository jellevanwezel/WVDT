<?php

class ListController extends Controller {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated users to access all actions
                'users' => array('@'),
            ),
            array('deny'),
        );
    }

    public function actionIndex() {
        $user_id = Yii::app()->user->id;
        $productUsers = ProductUser::model()->findAllByAttributes(array('user_id' => $user_id));
        if ($productUsers == null) {
            $productUsers = array();
        }
        $this->render('index', array(
            'list' => $productUsers,
        ));
    }

    public function actionAjaxGetProductList() {
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', Yii::app()->user->id, true);
        $products = ProductUser::model()->findAll($criteria);
        if ($products == null)
            $products = array();
        $this->renderPartial('productList', array(
            'products' => $products,
                )
        );
    }

    public function actionAjaxChangeProductAmount($id, $amount) {
        $model = ProductUser::model()->findByPk($id);
        if ($model == null) {
            throw new CHttpException(500, 'Product not found!');
        }
        if ($model->user_id != Yii::app()->user->id) {
            throw new CHttpException(500, 'Product not found!');
        }
        $model->amount = $amount;
        if (!$model->save()) {
            throw new CHttpException(500, 'Product amount couln\'t be updated');
        }
    }

    public function actionAjaxGetProducts($name) {
        $criteria = new CDbCriteria();
        $criteria->compare('name', $name, true);
        //$criteria->limit = 5;
        $products = Product::model()->findAll($criteria);
        if ($products == null || empty($name))
            $products = array();
        $this->renderPartial('products', array(
            'products' => $products,
                )
        );
    }

    public function actionAjaxAddProduct($id, $amount) {
        $productModel = Product::model()->findByPk($id);
        if ($productModel == null) {
            throw new CHttpException(404, "product not found!");
        }

        $criteria = new CDbCriteria();
        $criteria->compare('user_id', Yii::app()->user->id, true);
        $criteria->compare('product_id', $productModel->id, true);
        $productUserModel = ProductUser::model()->find($criteria);
        if ($productUserModel != null) {
            $productUserModel->amount += $amount;
        } else {

            $productUserModel = new ProductUser('create');
            $productUserModel->amount = $amount;
            $productUserModel->amount_scanned = 0;
            $productUserModel->product_id = $id;
            $productUserModel->user_id = Yii::app()->user->id;
        }

        if (!$productUserModel->save()) {
            var_dump($productUserModel->errors);
            //throw new CHttpException(500, "Could not save :(");
        }
        echo "$productModel->name is toegevoegd.";
    }

    public function actionAjaxRemoveProduct($id) {
        $PU = ProductUser::model()->findByPk($id);
        if ($PU == null || $PU->user_id != Yii::app()->user->id) {
            throw new CHttpException(404, "product not found!");
        }
        $PU->delete();
    }

    public function actionAjaxRemoveAllProducts() {
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', Yii::app()->user->id, true);
        $PU = ProductUser::model()->find($criteria);
        if ($PU == null) {
            throw new CHttpException(404, "Product list is already empty!");
        }
        $PU->deleteAll();
    }

}
