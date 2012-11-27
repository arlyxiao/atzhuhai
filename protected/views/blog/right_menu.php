<p><b><?php echo $blogUserModel->author; ?></b></p>
<p><a href="<?php echo $blogUserModel->blog_url; ?>" target="_blank">Author's Homepage</a></p>
<img width="200" src="<?php echo Yii::app()->params['blogAvatarPath'] . $blogUserModel->avatar; ?>" />
<p><?php echo $blogUserModel->description; ?></p>