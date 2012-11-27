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
		<span><a href="<?php echo Yii::app()->createUrl('/message'); ?>">Message</a></span>
		<div id="wt_0" style="margin-top: 9px;"> 
			<span><?php echo $messageModel->title; ?></span> 
			 
			<div class="content">
				<?php // echo nl2br($messageModel->content); ?>
			</div>

			<?php foreach ($threadList as $k => $v) { ?>
				<div style="border-bottom: 1px dotted #876789; margin: 5px 0px 0px 0px; padding: 5px 5px 5px 0px;">
					<div style="margin: 0px 0px 8px 0px; color: #987612; width: 100%;float: left;">
						<span style="float: left;"><?php echo $v->user->username; ?></span>
						<span style="margin-left: 29px;"><?php echo date('M j, Y, g:i a', strtotime($v->created_at)); ?></span>
				<?php if (Yii::app()->user->id == $v->user_id) { ?>
				<span style="margin-left: 29px;"><a href="<?php echo Yii::app()->createUrl('/message/del/', array('id' => $v->id)); ?>" onclick="return confirm('Delete?');">Delete</a></span>
				<?php } else { ?>
					<?php if (($messageModel->from_id == Yii::app()->user->id) && ($v->from_status == 0) ) { ?>
					<span style="margin-left: 29px;">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/new.gif" />
					</span>
					<?php } ?>
					
					<?php if (($messageModel->to_id == Yii::app()->user->id) && ($v->to_status == 0) ) { ?>
					<span style="margin-left: 29px;">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/new.gif" />
					</span>
					<?php } ?>
				<?php } ?>
					</div>
					<div style="">
						<?php echo nl2br($v->content); ?>
					</div>
				</div>
			<?php } ?>
			<p><?php  $this->widget('CLinkPager',array('pages'=>$pager));  ?></p>
			<?php 
				if ($messageModel->from_id == Yii::app()->user->id) {
					$this->setReadable($threadList, 'from_status'); 
				} else {
					$this->setReadable($threadList, 'to_status'); 
				}
			?>
					
			
				<div style="margin: 5px 0px 0px 0px;  padding: 5px 5px 5px 30px;">
	 				<div class="form">
 					<?php $form=$this->beginWidget('CActiveForm', array(
					    'id'=>'message-thread-reply-form',
					    'enableAjaxValidation'=>false,
					)); ?>

					<div class="row">
				        <?php echo $form->labelEx($messageThreadModel,'Reply'); ?>
				        <?php // echo $form->hiddenField($messageThreadModel,'user_id'); ?>
				        <?php echo $form->textarea($messageThreadModel,'content',array('rows'=>12, 'cols'=>60)); ?>
				        <?php echo $form->error($messageThreadModel,'content'); ?>
				    </div>
				    
				    <div class="row buttons">
					    <?php echo CHtml::submitButton('Post'); ?>
				    </div>
				    
				    <?php $this->endWidget(); ?>
				    </div>
				  </div>
		     
	 
		</div>
	</div>

	<div class="aside">

	</div>

</div>
</div>