<ul>


<li class="clearfix" style="border-bottom: 1px solid #989898;margin-bottom: 5px; padding-bottom: 5px;">
<a href="<?php echo Yii::app()->createUrl('/job'); ?>">
<span>Job Cover Page</span></a></li>
				<?php foreach ($categories as $k => $v) { ?>
				<li class="clearfix"><a href="<?php echo Yii::app()->createUrl('/job', array('category' => $v->id)); ?>">
				<span><?php echo $v->name; ?></span></a></li>
				<?php } ?>
</ul>