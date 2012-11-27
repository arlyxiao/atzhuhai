<h1><a href="<?php echo Yii::app()->createUrl('/admin/blog/new'); ?>">Add blog</a></h1>

<ul>
<?php foreach ($data as $k => $v) { ?>
<li><a href="<?php echo Yii::app()->createUrl('/admin/blog/edit', array('id' => $v->id)); ?>"><?php echo $v->title; ?></a>
&nbsp; &nbsp; 
<a href="<?php echo Yii::app()->createUrl('/admin/blog/delete', array('id' => $v->id)); ?>">Del</a>
</li>
<?php } ?>
</ul>


<p><?php  $this->widget('CLinkPager',array('pages'=>$pager));  ?></p>