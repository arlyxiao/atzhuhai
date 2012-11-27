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
	 <span style="margin-bottom: 9px; float: left; width: 100%;">
	 Send Message to 
	 <?php echo $userModel->username; ?>
	 </span>
<div id="wt_0">

	<div class="form">
	
	<?php $form=$this->beginWidget('CActiveForm', array(
	    'id'=>'message-new-form',
	    'enableAjaxValidation'=>false,
	)); ?>
	   
	    <div class="row">
	        <?php echo $form->labelEx($model,'title'); ?>
	        <?php echo $form->textField($model,'title', array('size'=>38,'maxlength'=>128)); ?>
	        <?php echo $form->error($model,'title'); ?>
	    </div>
	    
	    <div class="row">
	        <?php echo $form->labelEx($model,'content'); ?>
	        <?php echo $form->textarea($model,'content',array('rows'=>13, 'cols'=>60)); ?>
	        <?php echo $form->error($model,'content'); ?>
	    </div>
	
	    <div class="row">
	        
	    </div>
	
	
	    <div class="row buttons">
	    	<?php echo $form->hiddenField($model,'to_id', array('value'=> $to_id)); ?>
	        <?php echo CHtml::submitButton('Submit'); ?>
	    </div>
	
	<?php $this->endWidget(); ?>
	
	</div><!-- form -->

</div>


</div>

	<div class="aside">
	</div>

</div>
</div>

