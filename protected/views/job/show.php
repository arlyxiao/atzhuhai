<?php $this->pageTitle = Yii::app()->name . ' - ' .$jobModel->title; ?>
<div class="mc">

<div class="navs">
<div class="block_menu">

<em class="ft"></em><b class="ft"></b>
<?php $this->renderPartial('/job/left_menu', array('categories' => $categories)); ?>
<em class="fb"></em><b class="fb"></b>
</div>

<div id="calendarDiv"></div>

 

</div>


<div class="article">

<div id="wt_0">
	<h1><?php echo $jobModel->title; ?></h1>
	<?php if ($jobModel->created_by == Yii::app()->user->id) { ?>
	<p>
		<a href="<?php echo Yii::app()->createUrl('/job/edit/', array('id' => $jobModel->id)); ?>" style="color: green; margin-left: 5px;">(edit)</a>
		| 
		<a href="<?php echo Yii::app()->createUrl('/job/delete/', array('id' => $jobModel->id)); ?>" style="color: green; margin-left: 5px;" onclick="return confirm('Delete?')">(delete)</a>
	</p>
	<?php } ?>
	<div style="margin-bottom:0;overflow: hidden;" class="block1">
		<div class="content">
			<p><span class="small-title">Posted Date:</span> <?php echo date('M d, Y', strtotime($jobModel->created_at)); ?></p>
			<p><span class="small-title">Employer:</span> <?php echo $jobModel->company; ?></p>
	
			<?php echo nl2br($jobModel->content); ?>
			<p><span class="small-title">Email: </span>
			
			<?php if ($jobModel->created_by == Yii::app()->user->id) { ?>
			<?php echo $jobModel->email; ?>
			<?php } else { ?>
			<a href="<?php echo Yii::app()->createUrl('/signin'); ?>">Signin</a> 
			as job seeker in order to contact employers. 
			Please 
			<a href="<?php echo Yii::app()->createUrl('/signin'); ?>">signup</a>.
			<?php } ?>
			</p>
		</div>
	</div>
</div>


</div>

<div class="aside">
<a href="<?php echo Yii::app()->createUrl('/job/new'); ?>">
<img width="200" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/post-a-job.png" />
</a>
</div>

</div>
</div>