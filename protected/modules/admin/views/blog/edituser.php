<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'blog-user-newuser-form',
    'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'author'); ?>
        <?php echo $form->textField($model,'author'); ?>
        <?php echo $form->error($model,'author'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'avatar'); ?>
        <?php echo $form->fileField($model,'avatar'); ?>
        <?php echo $form->error($model,'avatar'); ?>
    </div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php
			$this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
			 'model'     =>  $model,
			 'attribute' =>  'description',
			 'height'    =>  '600px',
			 'width'     =>  '100%',
			 'fckeditor' =>  dirname(Yii::app()->basePath).'/web/fckeditor/fckeditor.php',
			 'fckBasePath' => Yii::app()->getBaseUrl(true).'/web/fckeditor/')
			 ); 
 		?>
		<?php echo $form->error($model,'description'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'blog_url'); ?>
        <?php echo $form->textField($model,'blog_url', array('size'=>50,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'blog_url'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->