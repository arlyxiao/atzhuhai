<div class="mc">

	<div class="navs">
		<div class="block_menu">
			<em class="ft"></em><b class="ft"></b>
			<?php $this->renderPartial('/classified/left_menu', array('categories' => $categories)); ?>
			<em class="fb"></em><b class="fb"></b>
		</div>
		
		<div id="calendarDiv"></div>
	</div>


	
	<div class="cleft" style="width: 480px;">
			<h1><?php echo $classifiedModel->title; ?>
			<?php if ($classifiedModel->user_id == Yii::app()->user->id) { ?>
			<a href="<?php echo Yii::app()->createUrl('/classified/edit/', array('id' => $classifiedModel->id)); ?>" style="color: green; margin-left: 5px;">(edit)</a>
			<?php } ?>
			</h1>
		
			<!--活动-->
			<div class="subjectwrap">
		
				<div class="fil">
					<a href="<?php echo $classifiedModel->web_url; ?>" target="_blank">
					<img title="Big" width="100" height="100" src="<?php if (empty($classifiedModel->avatar)) { echo Yii::app()->params['imagePath'] . 'event_dft.jpg';  } else { echo Yii::app()->params['classifiedAvatarPath'] . $classifiedModel->avatar; } ?>">
					</a>
				</div>
				<div style="width:239px;" id="info">
		
						 
					<span class="pl">Contact: </span><?php echo $classifiedModel->contact; ?><br>
					<span class="pl">Tel: </span><?php echo $classifiedModel->tel; ?><br>
					<div class="obmo">
						<span class="pl">Category: </span>
						<a href="<?php echo Yii::app()->createUrl('/classified/category', array('id' => $classifiedModel->category_id)); ?>">
						<?php echo $classifiedModel->category->name; ?></a><br>
						<a href="<?php echo $classifiedModel->web_url; ?>" target="_blank">
						<?php echo $classifiedModel->web_url; ?></a>
					</div>
			
					<br clear="all">
				</div>
			</div>
		
		
			<div class="topic-content clearfix">
				<h2>Description</h2>
				<div class="topic-doc">
					<p><?php echo nl2br($classifiedModel->content); ?></p>
				</div>	
			</div>
	
	</div>

<div class="aside">

<div class="create-classifieds">
<a href="<?php echo Yii::app()->createUrl('/classified/new'); ?>" >
<img width="200" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/postclassified.gif" />
</a>
</div>

</div>

</div>
</div>