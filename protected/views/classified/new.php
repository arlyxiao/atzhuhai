<?php if (isset($currentCategory)) { $this->pageTitle = 'Classified - ' . $currentCategory->name; } ?>
<div class="mc">

<div class="navs">
<div class="block_menu">

<em class="ft"></em><b class="ft"></b>
<?php
	$this->renderPartial('/classified/left_menu', array('categories' => $categories));
?>
<em class="fb"></em><b class="fb"></b>
</div>

<div id="calendarDiv"></div>

 

</div>


<div class="article">
	 
<div id="wt_0">

	<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'classified-new-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model, 'category_id', $dropDownCategories); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title', array('size'=>35,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'contact'); ?>
		<?php echo $form->textField($model,'contact', array('size'=>35,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'contact'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'tel'); ?>
		<?php echo $form->textField($model,'tel', array('size'=>35,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'tel'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'avatar'); ?>
		<?php echo $form->fileField($model,'avatar'); ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php // echo $form->textField($model,'content'); ?>
		<?php echo $form->textarea($model,'content',array('rows'=>16, 'cols'=>60)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'web_url'); ?> etc, Http://www.example.com
		<?php echo $form->textField($model,'web_url', array('size'=>35,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'web_url'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>


</div>

<div class="aside">
<a href="<?php echo Yii::app()->createUrl('/classified/new'); ?>">
<img width="200" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/postclassified.gif" />
</a>
</div>

</div>
</div>




