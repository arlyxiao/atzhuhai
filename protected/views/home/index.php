<?php $this->pageTitle = 'At Zhuhai | The portal of Zhuhai and Guangdong'; ?>
<style type="text/css">
#home_left {
	float: left;
	width: 30%;
}

#home_right {
	float: left;
	width: 70%;
}
</style>

	<div id="home_left"> 
	<span>
	<a style="color: black;" href="<?php echo Yii::app()->createUrl('/message'); ?>">
	People Connection
	</a>
	</span>
	<p>
	<a href="<?php echo Yii::app()->createUrl('/message'); ?>">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/ptaaaa.jpg" width="238px"  />
	</a>
	</p>
			<div style="margin-bottom:0;overflow: hidden;" class="block1">
				<div class="content">
			<span style="margin-bottom: 12px; float: left; width: 100%;">
				<a style="color: black;" href="<?php echo Yii::app()->createUrl('/event'); ?>">Event</a>
			| 
			<a style="color: black;" href="<?php echo Yii::app()->createUrl('/event/new'); ?>">Submit an Event</a>
			</span>
					<ul class="clearbox">
			 
						<?php foreach ($events as $k => $v) { ?>
						<li class="block clearfix">
						<div class="title">
						<a href="<?php echo Yii::app()->createUrl('/event/show/' . $v->id); ?>"><?php echo $v->title; ?></a>
						
						</div><a href="<?php echo Yii::app()->createUrl('/event/show/' . $v->id); ?>">
						<img class="actimgs" src="<?php if (empty($v->avatar)) { echo Yii::app()->params['imagePath'] . 'event_dft.jpg';  } else { echo Yii::app()->params['eventAvatarPath'] . $v->avatar; } ?>" width="48"></a>
						<div class="evtdesc">
						<?php echo date('M j, Y', strtotime($v->start_time)); ?>
						- 
						 <?php echo date('M j, Y', strtotime($v->end_time)); ?>
						 <br>
						 <a href="<?php echo Yii::app()->createUrl('/event/category', array('id' => $v->category_id)); ?>">
						<?php echo $v->category->name; ?></a><br>
						<?php echo $v->city->name_en; ?> <?php // echo $v->address; ?>
						</div></li>
						<?php } ?>
					</ul>
					
				</div>
			</div>
		
			 
	</div>
	
	<div id="home_right">
		<div id="wt_0">
		
		<ul class="clearbox">
			 <li style="margin-bottom: 12px;">
			<a style="color: black;" href="<?php echo Yii::app()->createUrl('/infobank'); ?>">Infobank</a>
			| 
			<a style="color: black;" href="<?php echo Yii::app()->createUrl('/infobank', array('category' => 14)); ?>">Zhuhai & Guangdong</a>
			</li>
			
			<?php foreach ($articles as $k => $v) { ?>
			<li class="block" style="float: left; width: 300px;">
				<div style="float: left; width: 110px;">
						<a href="<?php echo Yii::app()->createUrl('/infobank/show/' . $v->article_id); ?>">
						<img class="actimgs" width="100"  src="<?php if (empty($v->avatar)) { echo Yii::app()->params['imagePath'] . 'event_dft.jpg';  } else { echo Yii::app()->params['articleTopPath'] . $v->avatar; } ?>" width="48"></a>
				</div>
				  
				<a href="<?php echo Yii::app()->createUrl('/infobank/show/' . $v->article_id); ?>">
				<?php echo $v->article->title; ?></a>
			 	
			 	<br />
			 	<?php echo date('M d, Y', strtotime($v->article->created_at)); ?>
			 
			</li>
			<?php } ?>
		</ul>
		
		<ul class="clearbox" style="margin-top: 15px; float: left;">
			<li style="margin-bottom: 12px;">
			<a style="color: black;" href="<?php echo Yii::app()->createUrl('/ask'); ?>">Ask</a>
			| 
			<a style="color: black;" href="<?php echo Yii::app()->createUrl('/ask/new'); ?>">Click to Ask</a>
			</li>
				<?php foreach ($askList as $k => $v) { ?>
				<li class="li-list" style="height: 20px;">
				<span style="float: left;">
				<a href="<?php echo Yii::app()->createUrl('/ask/show/', array('id' => $v->id)); ?>">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/blue_dot.gif" alt="" /> 
				<?php echo $v->title; ?>
				</a>
				</span>
				<span style="float: right;">
					<span style="color: green;">
					<?php echo Ask::model()->countThread($v->id); ?>
					</span>
					&nbsp;&nbsp;
					<?php echo date('M d, Y', strtotime($v->created_at)); ?>
				</span>
				</li>
				<?php } ?>
			</ul>
		

			
			<ul class="clearbox" style="margin-top: 15px; float: left;"> 
			<li style="margin-bottom: 12px;">
			<a style="color: black;" href="<?php echo Yii::app()->createUrl('/job'); ?>">Job</a>
			| 
			<a style="color: black;" href="<?php echo Yii::app()->createUrl('/job/new'); ?>">Post a Job</a>
			</li>
			<?php 
				foreach ($jobList as $k => $v) { 
	 
			?>
			<li class="li-list" style="float: left; width: 100%;"> 
			<div style="float: left; width: 100%;">
				<div style="float: left;">
				<a href="<?php echo Yii::app()->createUrl('/job/show/', array('id' => $v->id)); ?>">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/red_dot.gif" alt="" /> 
				<?php echo $v->title; ?>
				</a>
				</div>
				
				<div style="float: right;">
				<span><?php echo date('M d, Y', strtotime($v->created_at)); ?></span>
				</div>
				 
			</div>
			
			<div style="float: left; width: 100%; margin: 4px 0px 3px 0px;">
				<div style="float: left;">
				<span class="small-title">Employer:</span>  
				<?php echo $v->company; ?>, 
				<?php echo Yii::app()->params['jobType'][$v->type]; ?>, 
				<span class="small-title">Location:</span>  <span><?php echo $v->city->name_en; ?></span>
				</div>
			</div>
			

		</li>
			<?php } ?>
 
		</ul>
			
			
 
			
			<ul class="clearbox" style="margin-top: 15px; float: left;">
			
			<li style="margin-bottom: 12px;">
			<a style="color: black;" href="<?php echo Yii::app()->createUrl('/job'); ?>">Classified</a>
			| 
			<a style="color: black;" href="<?php echo Yii::app()->createUrl('/classified/new'); ?>">Post your Classified</a>
			</li>
				<?php foreach ($classifiedList as $k => $v) { ?>
				<li class="li-list" style="height: 20px;">
				<span style="float: left;">
				<a href="<?php echo Yii::app()->createUrl('/classified/show', array('id' => $v->id)); ?>">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/dot.gif" alt="" /> 
				<?php echo $v->title; ?>
				</a>
				</span>
				<span style="float: right;">
					<?php echo date('M d, Y', strtotime($v->created_at)); ?>
				</span>
				</li>
				<?php } ?>
			</ul>


<!--
<p>
<span>
<a style="color: black;" href="<?php echo Yii::app()->createUrl('/blog'); ?>">Blog</a></span>
</p>				
			<ul class="clearbox">
		
				<?php foreach ($blogList as $k => $v) { ?>
				<li class="li-list" style="height: 20px;">
				<span style="float: left;">
				<img width="24" height="24" src="<?php echo Yii::app()->params['blogAvatarPath'] . $v->author->avatar; ?>" />
				
				</a>
				</span>
				<span style="margin-left: 5px;">
				<a href="<?php echo Yii::app()->createUrl('/blog/show', array('id' => $v->id)); ?>">
				<?php echo $v->title; ?>
				</a>
				</span>
				<span style="float: right;">
					<?php echo date('M d, Y', strtotime($v->created_at)); ?>
				</span>
				</li>
				<?php } ?>
			</ul>
  -->			
		</div>

 
		
		
	</div>


