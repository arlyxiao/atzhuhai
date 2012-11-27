<?php $this->pageTitle = Yii::app()->name . ' - ' .$articleModel->title; ?>
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

<div id="wt_0">
	<h1><?php echo $articleModel->title; ?></h1>
	<div style="margin-bottom:0;overflow: hidden;" class="block1">
		<div class="content">
			<?php echo $articleModel->content; ?>
			<?php if (!empty($articleModel->source_url)) { ?>
			<p>
				Source: 
				<a href="<?php echo $articleModel->source_url; ?>" target="_blank">
				<?php echo $articleModel->source_url; ?>
				</a>
			</p>
			<?php } ?>
		</div>
	</div>
</div>


</div>

<div class="aside">

</div>

</div>
</div>