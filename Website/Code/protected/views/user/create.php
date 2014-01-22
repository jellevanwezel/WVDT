<?php
/* @var $this UserController */
/* @var $model User */
$this->pageTitle = Yii::app()->name . ' - Registreren';
?>

<h1><?=$this->pageTitle?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>