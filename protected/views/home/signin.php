<h1>Signin</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-signin-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
  
	<div class="row buttons">
		<?php echo CHtml::submitButton('Signin'); ?>
		&nbsp;&nbsp;
		New to atzhuhai.com? <a href="<?php echo Yii::app()->createUrl('/signup'); ?>">Signup</a> Today.
	</div>

<?php $this->endWidget(); ?>

<p></p>

</div><!-- form -->