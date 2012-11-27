<div class="mc">

	<div class="navs">
		<div class="block_menu">
			<em class="ft"></em><b class="ft"></b>
			<?php include 'left_menu.php'; ?>
			<em class="fb"></em><b class="fb"></b>
		</div>
		
		<div id="calendarDiv"></div>
	</div>


	
	<div class="cleft" style="width: 480px;">
			<h1><?php echo $eventModel->title; ?>
			<?php if ($eventModel->user_id == Yii::app()->user->id) { ?>
			<a href="<?php echo Yii::app()->createUrl('/event/edit/', array('id' => $eventModel->id)); ?>" style="color: green; margin-left: 5px;">(edit)</a>
			<?php } ?>
			</h1>
		
			<!--活动-->
			<div class="subjectwrap">
		
				<div class="fil">
					<a href="<?php echo Yii::app()->params['eventAvatarPath'] . $eventModel->avatar; ?>" target="_blank">
					<img title="Big" width="180" height="180" src="<?php if (empty($eventModel->avatar)) { echo Yii::app()->params['imagePath'] . 'event_dft.jpg';  } else { echo Yii::app()->params['eventAvatarPath'] . $eventModel->avatar; } ?>">
					</a>
				</div>
				<div style="width:239px;" id="info">
		
						 
					<?php echo date('M d, Y', strtotime($eventModel->start_time)); ?>
					- 
					<?php echo date('M d, Y', strtotime($eventModel->end_time)); ?>
					<div class="obmo">
						<span class="pl">Venue: <?php if ($eventModel->area_id > 0) { echo $eventModel->city->name_en; } ?>, 
						<?php if ($eventModel->area_id > 0) { echo $eventModel->area->name_en; } ?>, 
						<?php echo $eventModel->address; ?></span> <br />
						<span class="pl">Organizer: </span> <?php echo $eventModel->organizer; ?><br>
						<span class="pl">Category: </span>
						<a href="<?php echo Yii::app()->createUrl('/event/category', array('id' => $eventModel->category_id)); ?>">
						<?php echo $eventModel->category->name; ?></a><br>
					</div>
			
					<br clear="all">
				</div>
			</div>
		
		
			<div class="topic-content clearfix">
				<h2>Description</h2>
				<div class="topic-doc">
					<p><?php echo nl2br($eventModel->description); ?></p>
				</div>	
			</div>
	
	</div>

<div class="aside">

<div class="create-events">
<a href="<?php echo Yii::app()->createUrl('/event/new'); ?>" >
<img src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/submit_event.jpg" />
</a>
</div>

</div>

</div>
</div>