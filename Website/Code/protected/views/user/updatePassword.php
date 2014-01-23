<?php
/* @var $this UserController */
/* @var $model User */
$this->pageTitle = Yii::app()->name . ' - Wachtwoord wijzigen';

?>

<h1><?= $this->pageTitle ?></h1>

<?php $this->renderPartial('_PasswordForm', array('model'=>$model)); ?>