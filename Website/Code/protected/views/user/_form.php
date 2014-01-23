<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>


<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'htmlOptions' => array('role' => "form", "class" => "form-horizontal"),
    'enableAjaxValidation' => false,
        ));
?>
<hr/>
<?php echo $form->errorSummary($model); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'first_name'); ?>
    <?php echo $form->textField($model, 'first_name', array('class' => "form-control", 'style'=>'width: 250px;')); ?>
    <?php echo $form->error($model, 'first_name'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'last_name'); ?>
    <?php echo $form->textField($model, 'last_name', array('class' => "form-control", 'style'=>'width: 250px;')); ?>
    <?php echo $form->error($model, 'last_name'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'email'); ?>
    <?php echo $form->textField($model, 'email', array('class' => "form-control", 'style'=>'width: 250px;')); ?>
    <?php echo $form->error($model, 'email'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'password'); ?>
    <?php echo $form->passwordField($model, 'password', array('class' => "form-control", 'style'=>'width: 250px;')); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'password_repeat'); ?>
    <?php echo $form->passwordField($model, 'password_repeat', array('class' => "form-control", 'style'=>'width: 250px;')); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>
<hr/>
<?php echo CHtml::submitButton('Registreren', array('class' => "btn btn-default")); ?>
<?php echo CHtml::link('Inloggen', $this->createAbsoluteUrl('site/index'), array('class'=>"btn btn-default")); ?>

<?php $this->endWidget(); ?>