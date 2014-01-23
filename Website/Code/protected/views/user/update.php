<?php
/* @var $this UserController */
/* @var $model User */
$this->pageTitle = Yii::app()->name . ' - Account wijzigen';

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1><?= $this->pageTitle ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>