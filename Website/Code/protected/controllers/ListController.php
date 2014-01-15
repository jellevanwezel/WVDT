<?php

class ListController extends Controller {

    public function actionIndex() {
        $user_id = Yii::app()->user->id;
        $productUsers = ProductUser::model()->findAllByAttributes(array('user_id'=>$user_id));
        if($productUsers == null){
            $productUsers = array();
        }
        $this->render('index',array(
            'list'=>$productUsers,
        ));
    }

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index'),
                'users' => array('@'),
            ),
        );
        return array(
            array('deny', 'users' => array('*'),
            ),
        );
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}