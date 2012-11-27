<?php

class ClassifiedController extends Controller
{
	public function filters()
    {
        return array(
            'accessControl',
        );
    }
    
	public function accessRules()
    {
        return array(
            array('deny',
	            'actions'=>array('new','edit','delete'),
	            'users'=>array('?'),
	        ),
        );
    }
    
	public function actionDelete()
	{
		$classifiedModel=new Classified;
		$id = $_GET['id'];
		
		if (empty($id)) {
			throw new CHttpException(404, 'The page cannot be found.');
		}

		$classifiedModel = $classifiedModel->findByPk($id);
		$oldAvatar = $classifiedModel->avatar;
		
		if (empty($classifiedModel->id) || ($classifiedModel->user_id != Yii::app()->user->id) ) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$classifiedModel->delete();
		
		$classifiedAvatarDir = Yii::app()->params['classifiedAvatarDir'];
		if ( is_file($classifiedAvatarDir . $oldAvatar) ) {
    		unlink($classifiedAvatarDir . $oldAvatar);
    	}
		
		$this->redirect(Yii::app()->createUrl('/classified' ));
	}

	public function actionEdit()
	{
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		$id = trim($_GET['id']);
	
		$classifiedModel=Classified::Model()->findByPk($id);
		$oldAvatar = $classifiedModel->avatar;
		
		if (empty($classifiedModel->id) || ($classifiedModel->user_id != Yii::app()->user->id) ) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		// Save ask
	    if(isset($_POST['Classified']))
	    {
	        $classifiedModel->attributes=$_POST['Classified'];
	        if($classifiedModel->validate())
	        {
	        	
	        	if ($_FILES['Classified']['size']['avatar'] > 0) {
	        		$classifiedAvatarDir = Yii::app()->params['classifiedAvatarDir'];
				    $classifiedModel->avatar = CUploadedFile::getInstance($classifiedModel, 'avatar');
				    
					$newFileName = time() . '_' . $classifiedModel->avatar;
			    	$classifiedModel->avatar->saveAs($classifiedAvatarDir . $newFileName);
			    	$classifiedModel->avatar = $newFileName;
			    	
			    	// Delete old
			    	if ( is_file($classifiedAvatarDir . $oldAvatar) ) {
			    		unlink($classifiedAvatarDir . $oldAvatar);
			    	}
	        	} else {
	        		$classifiedModel->avatar = $oldAvatar;
	        	}
	        	
	            $classifiedModel->updated_at = date('Y-m-d H:i:s');
	            // $classifiedModel->user_id = Yii::app()->user->id;
	            $classifiedModel->save();
	            
	            /**
	            if (!empty($newFileName) && is_file($classifiedAvatarDir . $oldAvatar) ) {
	            	echo $newFileName; die();
	            	unlink($classifiedAvatarDir . $oldAvatar);
	            }
	            **/
				
				$this->redirect(Yii::app()->createUrl('/classified' ));
	        }
	    }
	    
	    // Classified categories
	    $categories = Category::model()->classified()->findAll();
	    $dropDownCategories = CHtml::listData($categories, 'id', 'name');
	    
	    $this->render('new',array('model'=>$classifiedModel, 
	    						  'categories' => $categories,
	    						  'dropDownCategories' => $dropDownCategories
	    ));
	}

	public function actionIndex()
	{
		$classifiedModel=new Classified;
		
		$criteria = new CDbCriteria();
		$pagination = new CPagination( $classifiedModel->count( $criteria ));
		$pagination->pageSize = 8;
		$criteria->order = 'id desc';
		$pagination->applyLimit( $criteria );
		$result = $classifiedModel->findAll($criteria); 
		
		$categories = Category::model()->classified()->findAll();
		
		$this->render('index',array('data'=>$result,
									'pager'=>$pagination, 
									'categories' => $categories,
									'count' => count($result))
		);  
	}
	
	public function actionCategory()
	{
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$category_id = trim($_GET['id']);
		
		$currentCategory = Category::model()->findByPk($category_id);

		$classifiedModel=new Classified;
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('category_id = ' . $category_id); 
		$pagination = new CPagination( $classifiedModel->count( $criteria ));
		$pagination->pageSize = 8;
		$criteria->order = 'id desc';
		$pagination->applyLimit( $criteria );
		$result = $classifiedModel->findAll($criteria); 
		
		$categories = Category::model()->classified()->findAll();
		
		$this->render('index',array('data'=>$result,
									'currentCategory' => $currentCategory,
									'pager'=>$pagination, 
									'count' => count($result),
									'categories' => $categories)
		);
	}

	public function actionNew()
	{
		$classifiedModel=new Classified;
		
		// Save new ask
	    if(isset($_POST['Classified']))
	    {
	        $classifiedModel->attributes=$_POST['Classified'];
	        if($classifiedModel->validate())
	        {
	        	if ($_FILES['Classified']['size']['avatar'] > 0) {
	        		$classifiedAvatarDir = Yii::app()->params['classifiedAvatarDir'];
				    $classifiedModel->avatar = CUploadedFile::getInstance($classifiedModel, 'avatar');
				    
					$newFileName = time() . '_' . $classifiedModel->avatar;
			    	$classifiedModel->avatar->saveAs($classifiedAvatarDir . $newFileName);
			    	$classifiedModel->avatar = $newFileName;
	        	}
	            $classifiedModel->created_at = date('Y-m-d H:i:s');
	            $classifiedModel->user_id = Yii::app()->user->id;
	            $classifiedModel->save();
				$id = $classifiedModel->getPrimaryKey();
				
				$this->redirect(Yii::app()->createUrl('/classified' ));
	        }
	    }
	    
	    // Classified categories
	    $categories = Category::model()->classified()->findAll();
	    $dropDownCategories = CHtml::listData($categories, 'id', 'name');
	    
	    $this->render('new',array('model'=>$classifiedModel, 
	    						  'categories' => $categories,
	    						  'dropDownCategories' => $dropDownCategories
	    ));
	}
	
	public function actionShow()
	{
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		$id = trim($_GET['id']);
		
		$classifiedModel=Classified::Model()->findByPk($id);
		
		if (empty($classifiedModel->id)) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		
		$this->pageTitle = Yii::app()->name . ' - ' .$classifiedModel->title;
		
		$categories = Category::model()->classified()->findAll();;
		
		$this->render('show',array('classifiedModel'=> $classifiedModel, 'categories' => $categories));
	}

}