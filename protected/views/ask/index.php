<?php if (isset($currentCategory)) { $this->pageTitle = 'Ask - ' . $currentCategory->name; } ?>
<div class="mc">

<div class="navs">
<div class="block_menu">

<em class="ft"></em><b class="ft"></b>
<?php
	if (Yii::app()->controller->getAction()->getId() == 'my') {
		$this->renderPartial('/message/left_menu');
	} else {
		$this->renderPartial('/ask/left_menu', array('categories' => $categories));
	}
?>
<em class="fb"></em><b class="fb"></b>
</div>

<div id="calendarDiv"></div>

 

</div>


<div class="article">
	<div style="margin-bottom: 6px;">
	<?php if (isset($currentCategory)) { ?>
		<a href="<?php echo Yii::app()->createUrl('/Ask'); ?>">Ask</a>
		>>
		<?php echo $currentCategory->name; ?>
	<?php } ?>
	</div>
<div id="wt_0">

	<div class="content">
		<ul class="clearbox">
		
		<?php if ($count > 0) { ?>
		<?php foreach ($data as $k => $v) { ?>
		<li class="li-list" style="height: 20px;"> 
		<div style="float: left;">
		<a href="<?php echo Yii::app()->createUrl('/ask/show/', array('id' => $v->id)); ?>">
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/blue_dot.gif" alt="" /> 
		<?php echo $v->title; ?>
		</a>
		</div>
		<div style="float: right;">
		<span style="color: green;">
		<?php echo Ask::model()->countThread($v->id); ?>
		</span>
		&nbsp;&nbsp;
		<?php echo date('M d, Y', strtotime($v->created_at)); ?>
		</div>
		</li>
		<?php } ?>
		<?php } else { ?>
		<li>Empty Data, <a href="<?php echo Yii::app()->createUrl('/ask/new'); ?>">Click to Ask</a></li>
		<?php } ?>
		</ul>
	</div>

<p><?php  $this->widget('CLinkPager',array('pages'=>$pager));  ?></p>

</div>


</div>

<div class="aside">
<a href="<?php echo Yii::app()->createUrl('/ask/new'); ?>">
<img width="200" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/click_to_ask.png" />
</a>
</div>

</div>
</div>