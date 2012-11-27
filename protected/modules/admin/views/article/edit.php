<h1><a href="<?php echo Yii::app()->createUrl('/admin/article'); ?>">Article List</a>
 |  
<a href="<?php echo Yii::app()->createUrl('/admin/article/new'); ?>">Add article</a>
 
</h1>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-edit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title', array('size'=>50,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php
			$this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
			 'model'     =>  $model,
			 'attribute' =>  'content',
			 'height'    =>  '600px',
			 'width'     =>  '100%',
			 'fckeditor' =>  dirname(Yii::app()->basePath).'/web/fckeditor/fckeditor.php',
			 'fckBasePath' => Yii::app()->getBaseUrl(true).'/web/fckeditor/')
			 ); 
 		?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php foreach ($categories as $k => $v) { ?>
		<span style="margin-left: 10px;"><?php echo $v; ?></span>
		<input type="checkbox" name="categories[]" value="<?php echo $k; ?>" <?php if (in_array($k, $articleCategories)) { ?>checked<?php } ?> />
		<?php } ?>
		
		<?php // echo $form->labelEx($model,'category_id'); ?>
		<?php // echo $form->dropDownList($model, 'category_id', $categories); ?>
		<?php // echo $form->error($model,'category_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'source_url'); ?>
		<?php echo $form->textField($model,'source_url', array('size'=>50,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'source_url'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->