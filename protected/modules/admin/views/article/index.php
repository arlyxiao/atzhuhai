<h1><a href="<?php echo Yii::app()->createUrl('/admin/article/new'); ?>">Add article</a></h1>

<ul>
<?php foreach ($data as $k => $v) { ?>
<li style="line-height: 30px;"><a href="<?php echo Yii::app()->createUrl('/admin/article/edit', array('id' => $v->id)); ?>"><?php echo $v->title; ?></a>

<a href="<?php echo Yii::app()->createUrl('/admin/article/top', array('article_id' => $v->id)); ?>">top</a>
&nbsp; &nbsp; 
<a href="<?php echo Yii::app()->createUrl('/admin/article/delete', array('id' => $v->id)); ?>">Del</a>
</li>
<?php } ?>
</ul>


<p><?php  $this->widget('CLinkPager',array('pages'=>$pager));  ?></p>