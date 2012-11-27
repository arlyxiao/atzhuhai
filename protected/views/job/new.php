<?php if (isset($currentCategory)) { $this->pageTitle = 'Ask - ' . $currentCategory->name; } ?>
<div class="mc">

<div class="navs">
<div class="block_menu">

<em class="ft"></em><b class="ft"></b>
<?php include 'left_menu.php'; ?>
<em class="fb"></em><b class="fb"></b>
</div>

<div id="calendarDiv"></div>

 

</div>


<div class="article">
	 
<div id="wt_0">

	<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ask-new-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model, 'category_id', $dropDownCategories); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title', array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textField($model,'company', array('size'=>25,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>
		<?php echo $form->dropDownList($model, 'city_id', $dropDownCities); ?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model, 'type', Yii::app()->params['jobType']); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email', array('size'=>25,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php // echo $form->textField($model,'content'); ?>
		<?php echo $form->textarea($model,'content',array('rows'=>35, 'cols'=>68)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>


</div>

<div class="aside">
<a href="<?php echo Yii::app()->createUrl('/job/new'); ?>">
<img width="200" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/post-a-job.png" />
</a>
</div>

</div>
</div>




