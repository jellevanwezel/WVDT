<?php

class ListController extends Controller {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
//            array(
//                'deny',
//            ),
//            array(
//                'allow',
//                'actions' => array('index,ajaxGetProducts,ajaxAddProduct,AjaxRemoveProductUser'),
//                'users' => array('@'),
//            ),
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

    public function actionAjaxGetProducts($name) {
        $criteria = new CDbCriteria();
        $criteria->compare('name', $name, true);
        $criteria->limit = 5;
        $products = Product::model()->findAll($criteria);
        if ($products == null || empty($name))
            $products = array();
        $this->renderPartial('products', array(
            'products' => $products,
                )
        );
    }

    public function actionAjaxAddProduct($id, $amount) {
        $model = Product::model()->findByPk($id);
        if ($model == null) {
            throw new CHttpException(404, "product not found!");
        }
        $PU = new ProductUser('create');
        $PU->amount = $amount;
        $PU->amount_scanned = 0;
        $PU->product_id = $id;
        $PU->user_id = Yii::app()->user->id;
        if (!$PU->save()){
            var_dump($PU->errors);
            //throw new CHttpException(500, "Could not save :(");
        }
        echo "$model->name is toegevoegd.";
    }

    public function actionAjaxRemoveProduct($id) {
        $PU = ProductUser::model()->findByPk($id);
        if ($PU == null || $PU->user_id != Yii::app()->user->id) {
            throw new CHttpException(404, "product not found!");
        }
        $PU->delete();
    }

}