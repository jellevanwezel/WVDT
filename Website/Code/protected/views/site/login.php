<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$this->pageTitle = Yii::app()->name . ' - Login';
?>

<h1><?=$this->pageTitle?></h1>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'htmlOptions' => array('role' => "form", "class"=>"form-horizontal"),
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<hr/>
<div class="center-block">
<div class="form-group">
    <?php echo $form->labelEx($model, 'username'); ?>
    <?php echo $form->textField($model, 'username',array('class'=>"form-control", 'style'=>'width: 250px;')); ?>
    <?php echo $form->error($model, 'username'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'password'); ?>
    <?php echo $form->passwordField($model, 'password',array('class'=>"form-control", 'style'=>"width: 250px;")); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>

<div class="form-group">
    <?php echo $form->checkBox($model, 'rememberMe'); ?>
    <?php echo $form->label($model, 'rememberMe'); ?>
    <?php echo $form->error($model, 'rememberMe'); ?>
</div>
<hr/>

    <?php echo CHtml::submitButton('Login',array('class'=>"btn btn-default")); ?>

<?php $this->endWidget(); ?>
<?php echo CHtml::link('Registreren', $this->createAbsoluteUrl('user/create'), array('class'=>"btn btn-default")); ?>
</div>
