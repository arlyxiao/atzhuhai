<?php if (isset($currentCategory)) { $this->pageTitle = 'Infobank - ' . $currentCategory->name; } ?>
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
	<div style="margin-bottom: 5px;">
	<?php if (isset($currentCategory)) { ?>
		<a href="<?php echo Yii::app()->createUrl('/infobank'); ?>">Infobank</a>
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
		
		<li class="clearfix li-list" style="height: 20px;">
		<div style="float: left;">
		<a href="<?php echo Yii::app()->createUrl('/infobank/show/', array('id' => $v->id)); ?>">
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/dot.png" alt="" /> 
		<?php echo $v->title; ?>
		</a>
		</div>
		
		<div style="float: right;">
		<?php echo date('M d, Y', strtotime($v->created_at)); ?>
		</div>
		</li>
		<?php } ?>
		</ul>
	</div>

<p><?php  $this->widget('CLinkPager',array('pages'=>$pager));  ?></p>

</div>


</div>

<div class="aside">

</div>

</div>
</div>