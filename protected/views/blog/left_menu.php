<span>Bloggers</span>
<p>
<?php foreach ($authors as $k => $v) { ?>
<a href="<?php echo Yii::app()->createUrl('/blog/author/', array('id' => $v->id)); ?>">
<img width="36" height="36" alt="<?php echo $v->author; ?>" title="<?php echo $v->author; ?>" src="<?php echo Yii::app()->params['blogAvatarPath'] . $v->avatar; ?>" />
</a>
<?php } ?>
</p>