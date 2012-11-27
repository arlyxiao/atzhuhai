<div class="form">

<p>
<?php echo $model->avatar; ?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'partner-new-form',
    'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'avatar'); ?>
        <?php echo CHtml::activeFileField($model, 'avatar'); ?>
        <?php echo $form->error($model,'avatar'); ?>
    </div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'article_id'); ?>
		<?php echo $form->textField($model,'article_id', array('value'=> $article_id)); ?>
		<?php echo $form->error($model,'article_id'); ?>
	</div>
    
    
    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->