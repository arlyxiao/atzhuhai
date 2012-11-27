<?php if (isset($currentCategory)) { $this->pageTitle = 'Classified - ' . $currentCategory->name; } ?>
<div class="mc">

<div class="navs">
<div class="block_menu">

<em class="ft"></em><b class="ft"></b>
<?php
	$this->renderPartial('/classified/left_menu', array('categories' => $categories));
?>
<em class="fb"></em><b class="fb"></b>
</div>

<div id="calendarDiv"></div>

 

</div>


<div class="article">
	<div style="margin-bottom: 6px;">
	<?php if (isset($currentCategory)) { ?>
		<a href="<?php echo Yii::app()->createUrl('/classified'); ?>">Classified</a>
		>>
		<?php echo $currentCategory->name; ?>
	<?php } ?>
	</div>
<div id="wt_0">

	<div class="content">
		<ul class="clearbox">
		
		<?php if ($count > 0) { ?>
		<?php foreach ($data as $k => $v) { ?>
		<li class="li-list" style="float: left; width: 100%;"> 
			<div style="float: left; width: 100%;">
				<div style="float: left;">
				<a href="<?php echo Yii::app()->createUrl('/classified/show/', array('id' => $v->id)); ?>">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/dot.gif" alt="" /> 
				<?php echo $v->title; ?>
				</a>
				</div>
				<div style="float: right;">
				<?php if (Yii::app()->user->id == $v->user_id) { ?>
				<span style="margin-right: 9px;">
				<a href="<?php echo Yii::app()->createUrl('/classified/edit/', array('id' => $v->id)); ?>">Edit</a>
				| 
				<a href="<?php echo Yii::app()->createUrl('/classified/delete/', array('id' => $v->id)); ?>" onclick="return confirm('Delete?');">Delete</a>
				</span>
				<?php } ?>
				<?php echo date('M d, Y', strtotime($v->created_at)); ?>
				</div>
			</div>
			
			<div style="float: left;">
				 
					<?php echo substr($v->content, 0, 300); ?>...
					<a href="<?php echo Yii::app()->createUrl('/classified/show/', array('id' => $v->id)); ?>">
					<span style="font-size: 11px; color: green;">More</span>
					</a>
			</div>

		</li>

		<?php } ?>
		<?php } else { ?>
		<li>Empty Data, <a href="<?php echo Yii::app()->createUrl('/classified/new'); ?>">Post Your Classified</a></li>
		<?php } ?>
		</ul>
	</div>

<p><?php  $this->widget('CLinkPager',array('pages'=>$pager));  ?></p>

</div>


</div>

<div class="aside">
<a href="<?php echo Yii::app()->createUrl('/classified/new'); ?>">
<img width="200" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/postclassified.gif" />
</a>
</div>

</div>
</div>