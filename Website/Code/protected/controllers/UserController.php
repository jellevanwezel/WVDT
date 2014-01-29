<?php

class UserController extends Controller {

    public $defaultAction = 'create';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated users to access all actions
                'users' => array('@'),
            ),
            array(
                'allow',
                'actions' => array('create'),
                'users' => array('*'),
            ),
            array('deny'),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $oldPassword = $model->password;
            if ($model->validate()) {
                $model->password = CPasswordHelper::hashPassword($model->password);
                if ($model->save(false)) {
                    $login = new LoginForm();
                    $login->username = $model->email;
                    $login->password = $oldPassword;
                    if ($login->login())
                        $this->redirect(array('/list/index'));
                    throw new CHttpException(500, "Er ging iets mis :(");
                }
            }
            $model->password = $oldPassword;
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate() {
        $model = $this->loadModel(Yii::app()->user->id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

            if ($model->save(array()))
                $this->redirect(array('list/index'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionPassword() {
        $model = $this->loadModel(Yii::app()->user->id);
        $model->setScenario('password');
        $oldPassword = $model->password;
        $model->password = '';
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->password_old = $_POST['User']['password_old'];
            $new_password = $model->password;
            $passwordCheck = CPasswordHelper::verifyPassword($model->password_old,$oldPassword);
            if(!$passwordCheck){
                $model->addError('password_old', 'Wachtwoord incorrect.');
            }
            if ($model->validate(array('password','password_repeat')) && $passwordCheck) {
                $model->password = CPasswordHelper::hashPassword($model->password);
                if ($model->save(false, array('password')))
                    $this->redirect(array('list/index'));
                $model->password = $new_password;
            }
            $model->password_old = '';
        }

        $this->render('updatePassword', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete() {
        $id = Yii::app()->user->id;
        Yii::app()->user->logout();
        $this->loadModel($id)->delete();
        $this->redirect(array('/site/index'));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
