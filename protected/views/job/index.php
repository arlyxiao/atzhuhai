<?php if (isset($currentCategory)) { $this->pageTitle = 'job - ' . $currentCategory->name; } ?>
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
	<div style="margin-bottom: 5px;">
	<?php if (isset($currentCategory)) { ?>
		<a href="<?php echo Yii::app()->createUrl('/job'); ?>">job</a>
		>>
		<?php echo $currentCategory->name; ?>
	<?php } ?>
	</div>
<div id="wt_0">

	<div class="content">
		<ul class="clearbox">
		
		<?php 
			foreach ($data as $k => $v) { 
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
				<?php echo date('M d, Y', strtotime($v->created_at)); ?>
				</div>
			</div>
			
			<div style="float: left; width: 100%; margin: 4px 4px 0px 0px;">
				<div style="float: left;">
				<span class="small-title">Employer:</span>  
				<span><?php echo $v->company; ?></span>, 
				<?php echo Yii::app()->params['jobType'][$v->type]; ?>, 
				<span class="small-title">Location:</span>  <span><?php echo $v->city->name_en; ?></span>
				</div>
				
		 
			</div>
			

		</li>
		<?php } ?>
		</ul>
	</div>

<p><?php  $this->widget('CLinkPager',array('pages'=>$pager));  ?></p>

</div>


</div>

<div class="aside">
<a href="<?php echo Yii::app()->createUrl('/job/new'); ?>">
<img width="200" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/post-a-job.png" />
</a>
</div>

</div>
</div>