<?php $this->pageTitle = Yii::app()->name . ' - ' .$askModel->title; ?>
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
			<h1><?php echo $askModel->title; ?></h1>
			<div style="margin: 0px 0px 8px 0px; color: green; width: 100%;float: left;">
				<span style="float: left;">
<a href="<?php echo Yii::app()->createUrl('/message/new/', array('id' => $askModel->user_id)); ?>">				
<?php echo $askModel->user->username; ?></a></span>
				<span style="margin-left: 29px;"><?php echo date('M j, Y, g:i a', strtotime($askModel->created_at)); ?></span>
				<?php if (Yii::app()->user->id == $askModel->user_id) { ?>
				<span style="margin-left: 29px;"><a href="<?php echo Yii::app()->createUrl('/ask/edit/', array('id' => $askModel->id)); ?>">Edit</a></span>
				<?php } ?>
			</div>
		 
			<div class="content">
				<?php echo nl2br($askModel->content); ?>
			</div>
			
			<div style="margin-top: 8px;">
			<a href="#reply_box">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/reply_small.gif" />
			</a></div>
			
			<?php foreach ($threadList as $k => $v) { ?>
				<div style="border-top: 1px dotted #876789; margin: 15px 0px 0px 0px; padding: 5px 5px 5px 30px;">
					<div style="margin: 0px 0px 8px 0px; color: #987612; width: 100%;float: left;">
						<span style="float: left;"><?php echo $v->user->username; ?></span>
						<span style="margin-left: 29px;"><?php echo date('M j, Y, g:i a', strtotime($v->created_at)); ?></span>
				<?php if (Yii::app()->user->id == $v->user_id) { ?>
				<span style="margin-left: 29px;"><a href="<?php echo Yii::app()->createUrl('/ask/del/', array('id' => $v->id)); ?>" onclick="return confirm('Delete?');">Delete</a></span>
				<?php } ?>
					</div>
					<div style="">
						<?php echo nl2br($v->content); ?>
					</div>
				</div>
			<?php } ?>
			<p><?php  $this->widget('CLinkPager',array('pages'=>$pager));  ?></p>
			
			
					
					
			
				<div style="border-top: 1px dotted #876789; margin: 15px 0px 0px 0px;  padding: 5px 5px 5px 30px;">
	 				<div class="form">
 					<?php $form=$this->beginWidget('CActiveForm', array(
					    'id'=>'ask-thread-reply-form',
					    'enableAjaxValidation'=>false,
					)); ?>
					<!--
					<p class="note">Fields with <span class="required">*</span> are required.</p>
					  -->
					<div class="row">
				        <?php echo $form->labelEx($askThreadModel,'Reply'); ?>
				        <?php // echo $form->hiddenField($askThreadModel,'user_id'); ?>
				        <?php echo $form->textarea($askThreadModel,'content',array('rows'=>16, 'cols'=>60)); ?>
				        <?php echo $form->error($askThreadModel,'content'); ?>
				    </div>
				    
				    <a name="reply_box">&nbsp;</a>
				    
				    <div class="row buttons">
					    <?php if (Yii::app()->user->isGuest) { ?>
					    	Please 
					    	<a style="color: green;" href="<?php echo Yii::app()->createUrl('/signin'); ?>">signin</a> to reply.
					    <?php } else { ?>
					        <?php echo CHtml::submitButton('Post'); ?>
					     <?php } ?>
				    </div>
				    
				    <?php $this->endWidget(); ?>
				    </div>
				  </div>
		     
	 
		</div>
	</div>

	<div class="aside">
		<a href="<?php echo Yii::app()->createUrl('/ask/new'); ?>">
		<img width="200" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/click_to_ask.png" />
		</a>
	</div>

</div>
</div>