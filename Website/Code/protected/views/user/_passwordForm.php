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
    <?php echo $form->labelEx($model, 'password_old'); ?>
    <?php echo $form->passwordField($model, 'password_old', array('class' => "form-control", 'style' => 'width: 250px;')); ?>
    <?php echo $form->error($model, 'password_old'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'password'); ?>
    <?php echo $form->passwordField($model, 'password', array('class' => "form-control", 'style' => 'width: 250px;')); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'password_repeat'); ?>
    <?php echo $form->passwordField($model, 'password_repeat', array('class' => "form-control", 'style' => 'width: 250px;')); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>
<hr/>

<?php echo CHtml::link('<span class="glyphicon glyphicon-chevron-left"></span> Terug', array('list/index'), array('class' => "btn btn-primary")); ?>
<?php echo CHtml::htmlButton('<span class="glyphicon glyphicon-floppy-disk"></span> Opslaan', array('class' => "btn btn-primary pull-right")); ?>


<?php $this->endWidget(); ?>