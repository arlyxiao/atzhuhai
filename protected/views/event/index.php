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

<div style="margin-bottom:0;overflow: hidden;" class="block1"><div class="content">
<ul class="clearbox">

<?php foreach ($data as $k => $v) { ?>
<li class="block clearfix">
<div class="title">
<a href="<?php echo Yii::app()->createUrl('/event/show/' . $v->id); ?>"><?php echo $v->title; ?></a>

</div><a href="<?php echo Yii::app()->createUrl('/event/show/' . $v->id); ?>">
<img class="actimgs" src="<?php if (empty($v->avatar)) { echo Yii::app()->params['imagePath'] . 'event_dft.jpg';  } else { echo Yii::app()->params['eventAvatarPath'] . $v->avatar; } ?>" width="48"></a>
<div class="evtdesc">
<?php echo date('M d, Y', strtotime($v->start_time)); ?>
   - 
 <?php echo date('M d, Y', strtotime($v->end_time)); ?>
  <br>
  <a href="<?php echo Yii::app()->createUrl('/event/category', array('id' => $v->category_id)); ?>">
<?php echo $v->category->name; ?></a><br>
<?php echo $v->city->name_en; ?> <?php //echo $v->address; ?>
</div></li>
<?php } ?>
 
 
</ul></div></div>

<p><?php  $this->widget('CLinkPager',array('pages'=>$pager));  ?></p>

</div>


</div>

<div class="aside">

<div class="create-events">
<a href="<?php echo Yii::app()->createUrl('/event/new'); ?>" >
<img src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/submit_event.jpg" />
</a>
</div>


</div>

</div>
</div>