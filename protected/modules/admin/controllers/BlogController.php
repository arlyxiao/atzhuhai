<?php

class BlogController extends Controller
{
	public function actionDelete()
	{
		$blogModel=new Blog;
		$id = $_GET['id'];
		
		$blogModel = $blogModel->findByPk($id);
		$blogModel->delete();
		
		$this->redirect(Yii::app()->createUrl('/admin/blog'));
	}
	
	public function actionDeleteUser()
	{
		$blogUserModel=new BlogUser;
		$id = $_GET['id'];
		
		$blogUserModel = $blogUserModel->findByPk($id);
		$blogUserModel->delete();
		
		$blogAvatarDir = Yii::app()->params['blogAvatarDir'];
		if ( is_file($blogAvatarDir . $oldAvatar) ) {
    		unlink($blogAvatarDir . $oldAvatar);
    	}
		
		$this->redirect(Yii::app()->createUrl('/admin/blog'));
	}

	public function actionEdit()
	{
		$id = trim($_GET['id']);
		$blogModel=Blog::Model()->findByPk($id);
		
		if(isset($_POST['Blog'])) {
			$blogModel->attributes=$_POST['Blog'];
			$blogModel->save();
			
			$this->redirect(Yii::app()->createUrl('/admin/blog/edit', array('id' => $blogModel->id)));
		}
		
		// Blog Users
	    $users = BlogUser::model()->findAll();
	    $dropDownUsers = CHtml::listData($users, 'id', 'author');
	    
		$this->render('edit', array('model'=>$blogModel,
									'dropDownUsers' => $dropDownUsers
		));
	}

	public function actionIndex()
	{
		$blogModel=new Blog;
		
		$criteria = new CDbCriteria();
		// $criteria->addCondition(....); 
		$pagination = new CPagination( $blogModel->count( $criteria ));
		$pagination->pageSize = 20;
		$criteria->order = 'id desc';
		$pagination->applyLimit( $criteria );
		$result = $blogModel->findAll($criteria);
		
		$this->render('index',array('data'=>$result,
									'pager'=>$pagination)
		);  
	}

	public function actionNew()
	{
		$blogModel=new Blog;
		
		if(isset($_POST['Blog']))
	    {
	        $blogModel->attributes=$_POST['Blog'];
	        if($blogModel->validate())
	        {
				$blogModel->save();
				$id = $blogModel->getPrimaryKey();
				 
				
				$this->redirect(Yii::app()->createUrl('/admin/blog/edit', array('id' => $id) ));
	        }
	    }
	    
		// Blog Users
	    $users = BlogUser::model()->findAll();
	    $dropDownUsers = CHtml::listData($users, 'id', 'author');
	    
		$this->render('edit', array('model'=>$blogModel,
									'dropDownUsers' => $dropDownUsers
		));
	}
	
	
	public function actionNewuser()
	{
		$blogUserModel=new BlogUser;
		
		if(isset($_POST['BlogUser']))
	    {
	        $blogUserModel->attributes=$_POST['BlogUser'];
	        $blogAvatarDir = Yii::app()->params['blogAvatarDir'];
		    $blogUserModel->avatar = CUploadedFile::getInstance($blogUserModel, 'avatar');
	        if($blogUserModel->validate())
	        {
	        	// Blog avatar name
		    	$newFileName = time() . '_' . $blogUserModel->avatar;
		    	$blogUserModel->avatar->saveAs($blogAvatarDir . $newFileName);
		    	$blogUserModel->avatar = $newFileName;
		    	
	            $blogUserModel->created_at = date('Y-m-d H:i:s');
				$blogUserModel->save();
				$id = $blogUserModel->getPrimaryKey();
				 
				
				$this->redirect(Yii::app()->createUrl('/admin/blog/edituser', array('id' => $id) ));
	        }
	    }
	    
		$this->render('edituser', array('model'=>$blogUserModel));
	}
	
	
	public function actionEdituser()
	{
		$id = trim($_GET['id']);
		$blogUserModel=BlogUser::Model()->findByPk($id);
		$currentAvatar = $blogUserModel->avatar;
		
		if(isset($_POST['BlogUser']))
	    {
	        $blogUserModel->attributes=$_POST['BlogUser'];
	        $blogAvatarDir = Yii::app()->params['blogAvatarDir'];
		    $blogUserModel->avatar = CUploadedFile::getInstance($blogUserModel, 'avatar');
	        if($blogUserModel->validate())
	        {
	        	// Blog avatar name
		        if ($_FILES['BlogUser']['size']['avatar'] > 0) {
					$blogAvatarDir = Yii::app()->params['blogAvatarDir'];
				    $blogUserModel->avatar = CUploadedFile::getInstance($blogUserModel, 'avatar');
				    
					$newFileName = time() . '_' . $blogUserModel->avatar;
			    	$blogUserModel->avatar->saveAs($blogAvatarDir . $newFileName);
			    	$blogUserModel->avatar = $newFileName;
			    	
		       		// Delete old
			    	if ( is_file($blogAvatarDir . $currentAvatar) ) {
			    		unlink($blogAvatarDir . $currentAvatar);
			    	}
				} else {
					$blogUserModel->avatar = $currentAvatar;
				}
		    	
	            $blogUserModel->created_at = date('Y-m-d H:i:s');
				$blogUserModel->save();
				$id = $blogUserModel->getPrimaryKey();
				 
				
				$this->redirect(Yii::app()->createUrl('/admin/blog/edituser', array('id' => $id) ));
	        }
	    }
	    
		$this->render('edituser', array('model'=>$blogUserModel));
	}

	
}