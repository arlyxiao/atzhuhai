<?php
$this->pageTitle=Yii::app()->name . ' - Site Guide';
$this->breadcrumbs=array(
	'Guide',
);
?>

<h1>Guide</h1>

<p style="float: left; width: 100%; margin-top: 15px;">
Infobank
</p>

<p>
<?php 
	foreach ($infobankCategories as $k => $v) { 
?>

<span style="float: left; width: 140px; margin-bottom: 5px;">
<a href="<?php echo Yii::app()->createUrl('/infobank', array('category' => $v->id)); ?>" target="_blank">
<?php echo $v->name; ?> <br />
</a>
</span>

<?php } ?>
</p>



<p style="float: left; width: 100%; margin-top: 15px;">
Event
</p>

<p>
<?php 
	foreach ($eventCategories as $k => $v) { 
?>

<span style="float: left; width: 140px; margin-bottom: 5px;">
<a href="<?php echo Yii::app()->createUrl('/event', array('category' => $v->id)); ?>" target="_blank">
<?php echo $v->name; ?> <br />
</a>
</span>

<?php } ?>
</p>


<p style="float: left; width: 100%; margin-top: 15px;">
Ask
</p>

<p>
<?php 
	foreach ($askCategories as $k => $v) { 
?>

<span style="float: left; width: 140px; margin-bottom: 5px;">
<a href="<?php echo Yii::app()->createUrl('/ask', array('category' => $v->id)); ?>" target="_blank">
<?php echo $v->name; ?> <br />
</a>
</span>

<?php } ?>
</p>


<p style="float: left; width: 100%; margin-top: 15px;">
Classified
</p>

<p>
<?php 
	foreach ($classifiedCategories as $k => $v) { 
?>

<span style="float: left; width: 140px; margin-bottom: 5px;">
<a href="<?php echo Yii::app()->createUrl('/classified', array('category' => $v->id)); ?>" target="_blank">
<?php echo $v->name; ?> <br />
</a>
</span>

<?php } ?>
</p>