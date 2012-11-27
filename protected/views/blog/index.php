<?php if (isset($currentCategory)) { $this->pageTitle = 'Blog - ' . $currentAuthor->name; } ?>
<div class="mc">

<div class="navs"> 
<?php
	$this->renderPartial('/blog/left_menu', array('authors' => $authors));
?>
 

<div id="calendarDiv"></div>

</div>


<div class="article">
 
	<div style="margin-bottom: 10px;"> 
		<a href="<?php echo Yii::app()->createUrl('/blog'); ?>">&gt;&gt;Blog Cover Page</a>
	</div>
<div id="wt_0">

	<div class="content">
		<ul class="clearbox">
		 
		<?php foreach ($data as $k => $v) { ?>
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
	</div>

<p><?php  $this->widget('CLinkPager',array('pages'=>$pager));  ?></p>

</div>


</div>

<div class="aside">
<?php
	if (isset($blogUserModel)) {
		$this->renderPartial('/blog/right_menu', array('blogUserModel' => $blogUserModel));
	}
	
?>
</div>

</div>
</div>