<div class="mc">

<div class="navs">
<div class="block_menu">

<em class="ft"></em><b class="ft"></b>
<?php $this->renderPartial('/message/left_menu')?>
<em class="fb"></em><b class="fb"></b>
</div>

<div id="calendarDiv"></div>

 

</div>

<div class="article" style="width: 620px;">
  
	<div style="margin-bottom: 9px;">
	<a href="<?php echo Yii::app()->createUrl('/message'); ?>">
	Message</a> 
	</div>
	<div class="content">
		
		<ul class="clearbox">
		<?php if ($count > 0) { ?>
		<li class="li-list" style="height: 20px;"> 
		<span style="width: 20px; float: left;">User</span>
		<span style="float: right; width: 300px;">Subject</span>
		</li>
		<?php foreach ($data as $k => $v) { ?>
		<li class="li-list" style="height: 20px;"> 
		<div style="float: left;">
		<span style="margin-right: 5px;">
		<?php 
			if (Yii::app()->user->id == $v->from_id) {
				echo $v->toUser->username; 
			} else {
				echo $v->fromUser->username; 
			}
		?>
		</span>
		<a href="<?php echo Yii::app()->createUrl('/message/show/', array('id' => $v->id)); ?>">
		<?php echo $v->title; ?>
		</a>
		
		
		<?php 
			$n = Message::model()->countUnreadThread($v->id, $v->from_id);
			if ($n > 0) {
		?>
		<span style="margin-left: 5px;"><?php echo $n; ?>
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/new.gif" />
		</span>
		<?php } ?>
		
		</div>
		<div style="float: right;"><?php echo date('M j, y, H:i', strtotime($v->created_at)); ?></div>
		</li>
		<?php } ?>
		<?php } else { ?>
		<li>No Private Message</li>
		<?php } ?>
		</ul>
		
	</div>

<p><?php  $this->widget('CLinkPager',array('pages'=>$pager));  ?></p>
</div>
 

</div>
</div>