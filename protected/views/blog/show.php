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
	<h1><?php echo $blogModel->title; ?></h1>
	<span style="margin: 3px 0px 3px 0px;"><?php echo date('M d, Y', strtotime($blogModel->created_at)); ?></span>
	<div style="margin-bottom:0;overflow: hidden;" class="block1">
		<div class="content">
			<?php echo $blogModel->content; ?>
			<p>Source: <br />
			<a href="<?php echo $blogModel->source_url; ?>" target="_blank">
			<?php echo $blogModel->source_url; ?></a></p>
		</div>
	</div>
</div>
</div>

 
<div class="aside">
<?php
	$this->renderPartial('/blog/right_menu', array('blogUserModel' => $blogUserModel));
?>
</div>

</div>
</div>