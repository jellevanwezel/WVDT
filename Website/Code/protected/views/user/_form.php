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

<?php echo $form->errorSummary($model); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'email'); ?>
    <?php echo $form->textField($model, 'email', array('class' => "form-control")); ?>
    <?php echo $form->error($model, 'email'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'password'); ?>
    <?php echo $form->passwordField($model, 'password', array('class' => "form-control")); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'password_repeat'); ?>
    <?php echo $form->passwordField($model, 'password_repeat', array('class' => "form-control")); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>
<?php echo CHtml::submitButton('Versuur', array('class' => "btn btn-default")); ?>

<?php $this->endWidget(); ?>