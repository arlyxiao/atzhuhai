<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/web/css/base.css" media="" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/web/css/event.css" media="" />
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/web/css/topic_event.css" id="skin" />
	
	
	<meta content="all" name="robots" />
<meta name="author" content="At Zhuhai" />
<meta name="Copyright" content="At Zhuhai" />
<meta name="keywords" content="zhuhai, job in zhuhai, job in guangdong, zhuhai jobs, event, classfied, zhuhai travel, zhuhai entertainment" />
<meta name="description" content="atzhuhai.com is an online portal site rich in information about zhuhai and Guangdong. We provide events, job, classfied. etc." />
	
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/web/images/favicon32.ico?<?php echo time(); ?>" type="image/x-icon" />
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26691951-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body>

	<!--header-->
	<div class="header">
		<div class="hc">
			<div class="left">
				<a href="<?php echo Yii::app()->createUrl('/home'); ?>" style="font-size: 32px;color: white;">
				<img width="220px" height="40px" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/logo.png" />
				</a>
			</div>
			
			<div class="nav">
				<ul>
					<li><a href="<?php echo Yii::app()->createUrl('/home'); ?>">Home</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/job'); ?>">Job</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/event'); ?>">Event</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/ask'); ?>">Ask</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/classified'); ?>">Classified</a></li>
				</ul>
			</div>
		
			<div class="right">
				<a href="<?php echo Yii::app()->createUrl('/ask/my'); ?>">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/avatar_24.gif" width="24" align="absmiddle" /></a> 
				<span style="font-size: 11px;">
				<?php if (!Yii::app()->user->isGuest) { ?>
				<a href="<?php echo Yii::app()->createUrl('/signout'); ?>">Signout</a>
				<?php } ?>
				</span>
				<br />
				<?php if (Yii::app()->user->isGuest) {?>
				<a href="<?php echo Yii::app()->createUrl('/signin'); ?>">Signin</a> | 
				<a href="<?php echo Yii::app()->createUrl('/signup'); ?>">Signup</a>
				<?php } else { ?>
					<?php echo Yii::app()->user->username; ?>, 
					
					<a href="<?php echo Yii::app()->createUrl('/message'); ?>">
					<?php $n = Message::model()->countUnreadMessage();?>
					<?php if ($n > 0) { ?>
					<?php echo $n; ?>
					<?php } ?>
					Message</a>
				<?php } ?>
			</div>
		</div>
	</div>
	
	<!--APP NAV-->
	
	<!--main-->
	<div class="midder ">
		<div id="content">
	 		<?php echo $content; ?>
	 	</div>
	</div>
	
	<!--footer-->
	<div class="footer">
		<p>
			<a href="<?php echo Yii::app()->createUrl('/site/terms'); ?>">Terms of Service</a>
			 | 
			 <a href="<?php echo Yii::app()->createUrl('/site/privacy'); ?>">Privacy Policy</a>
			 | 
			<a href="<?php echo Yii::app()->createUrl('/site/contact'); ?>">Contact</a> 
			 | 
			<a href="<?php echo Yii::app()->createUrl('/link'); ?>">Links</a> 
			 | 
			<a href="<?php echo Yii::app()->createUrl('/infobank'); ?>">Infobank</a> 
			| 
			<a href="<?php echo Yii::app()->createUrl('/site/guide'); ?>">Guide</a> 
		</p>
	Copyright © 2011 by  
	<a class="softname" href="<?php echo Yii::app()->createUrl('/home'); ?>">atzhuhai.com</a> 
	All Rights Reserved. 
	
	</div>

</body>
</html>