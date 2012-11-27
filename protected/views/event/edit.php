<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-edit-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title', array('size'=>52,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'organizer'); ?>
		<?php echo $form->textField($model,'organizer'); ?>
		<?php echo $form->error($model,'organizer'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		
		<b>City</b>  &nbsp; 
		<?php echo $form->dropDownList($model, 'city_id', $cities, 
		array(
		// 'options' => array('4'=>array('selected'=>true)),
		'ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('event/areas'), //url to call.
		'update'=>'#Event_area_id', //selector to update
		'data'=>array('city_id'=>'js:this.value')))
		); 
		?>
		<b>&nbsp; Area</b>  &nbsp; <?php echo $form->dropDownList($model, 'area_id', $defaultAreas); ?>
		<b>&nbsp; Street</b>  &nbsp; <?php echo $form->textField($model,'address', array('size'=>38,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model, 'category_id', $categories); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avatar'); ?>
		<?php echo $form->fileField($model,'avatar'); ?>
		<?php // echo $form->hiddenField($model,'avatar'); ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_time'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		    $this->widget('CJuiDateTimePicker',array(
		        'model'=>$model, //Model object
		        'attribute'=>'start_time', //attribute name
		        'mode'=>'date', //use "time","date" or "datetime" (default)
		        'options'=>array() // jquery plugin options
		    ));
		?>
		<?php // echo $form->textField($model,'start_time'); ?>
		<?php echo $form->error($model,'start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_time'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		    $this->widget('CJuiDateTimePicker',array(
		        'model'=>$model, //Model object
		        'attribute'=>'end_time', //attribute name
		        'mode'=>'date', //use "time","date" or "datetime" (default)
		        'options'=>array() // jquery plugin options
		    ));
		?>
		<?php // echo $form->textField($model,'end_time'); ?>
		<?php echo $form->error($model,'end_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textarea($model,'description',array('rows'=>12, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->