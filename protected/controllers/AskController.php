<?php

class AskController extends Controller
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
	            'actions'=>array('new','edit','delete', 'my'),
	            'users'=>array('?'),
	        ),
        );
    }
    
	public function actionEdit()
	{
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		$id = trim($_GET['id']);
	
		$askModel=Ask::Model()->findByPk($id);
		
		if (empty($askModel->id) || ($askModel->user_id != Yii::app()->user->id) ) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		// Save ask
	    if(isset($_POST['Ask']))
	    {
	        $askModel->attributes=$_POST['Ask'];
	        if($askModel->validate())
	        {
	            $askModel->updated_at = date('Y-m-d H:i:s');
	            $askModel->user_id = Yii::app()->user->id;
	            $askModel->save();
				$id = $askModel->getPrimaryKey();
				
				$this->redirect(Yii::app()->createUrl('/ask/show/', array('id' => $id) ));
	        }
	    }
	    
	    // Ask categories
	    $categories = Category::model()->ask()->findAll();
	    $dropDownCategories = CHtml::listData($categories, 'id', 'name');
	    
	    $this->render('new',array('model'=>$askModel, 
	    						  'categories' => $categories,
	    						  'dropDownCategories' => $dropDownCategories
	    ));
	}

	public function actionIndex()
	{
		$askModel=new Ask;
		
		$criteria = new CDbCriteria();
		// $criteria->addCondition(....); 
		$pagination = new CPagination( $askModel->count( $criteria ));
		$pagination->pageSize = 20;
		$criteria->order = 'id desc';
		$pagination->applyLimit( $criteria );
		$result = $askModel->findAll($criteria); 
		
		$categories = Category::model()->ask()->findAll();
		
		$this->render('index',array('data'=>$result,
									'pager'=>$pagination, 
									'categories' => $categories,
									'count' => count($result))
		);  
	}
	
	public function actionMy()
	{
		$askModel=new Ask;
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('user_id = ' . Yii::app()->user->id); 
		$pagination = new CPagination( $askModel->count( $criteria ));
		$pagination->pageSize = 20;
		$criteria->order = 'id desc';
		$pagination->applyLimit( $criteria );
		$result = $askModel->findAll($criteria);
		
		$this->render('index',array('data'=>$result,
									'pager'=>$pagination,
									'count' => count($result)
		));
	}
	
	public function actionCategory()
	{
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$category_id = trim($_GET['id']);
		
		$currentCategory = Category::model()->findByPk($category_id);

		$askModel=new Ask;
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('category_id = ' . $category_id); 
		$pagination = new CPagination( $askModel->count( $criteria ));
		$pagination->pageSize = 20;
		$criteria->order = 'id desc';
		$pagination->applyLimit( $criteria );
		$result = $askModel->findAll($criteria); 
		
		$categories = Category::model()->ask()->findAll();
		
		$this->render('index',array('data'=>$result,
									'currentCategory' => $currentCategory,
									'pager'=>$pagination, 
									'count' => count($result),
									'categories' => $categories)
		);
	}

	public function actionNew()
	{
		$askModel=new Ask;
		
		// Save new ask
	    if(isset($_POST['Ask']))
	    {
	        $askModel->attributes=$_POST['Ask'];
	        if($askModel->validate())
	        {
	            $askModel->created_at = date('Y-m-d H:i:s');
	            $askModel->user_id = Yii::app()->user->id;
	            $askModel->save();
				$id = $askModel->getPrimaryKey();
				
				$this->redirect(Yii::app()->createUrl('/ask/show/', array('id' => $id) ));
	        }
	    }
	    
	    // Ask categories
	    $categories = Category::model()->ask()->findAll();
	    $dropDownCategories = CHtml::listData($categories, 'id', 'name');
	    
	    $this->render('new',array('model'=>$askModel, 
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
		
		$askModel=Ask::Model()->findByPk($id);
		
		if (empty($askModel->id)) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$this->pageTitle = Yii::app()->name . ' - ' .$askModel->title;
		
		// Ask categories
		$categories = Category::model()->ask()->findAll();
		
		// Ask thread
		$askThreadModel=new AskThread;
		
		// Reply
		if(isset($_POST['AskThread']) && (Yii::app()->user->id > 0))
	    {
	        $askThreadModel->attributes=$_POST['AskThread'];
	        if($askThreadModel->validate())
	        {
	            $askThreadModel->created_at = date('Y-m-d H:i:s');
	            $askThreadModel->user_id = Yii::app()->user->id;
	            $askThreadModel->ask_id = $id;
	            $askThreadModel->save();
				
				$this->redirect(Yii::app()->createUrl('/ask/show/', array('id' => $id) ));
	        }
	    }
	    
	    // Ask thread list
	    $criteria = new CDbCriteria();
		$criteria->addCondition('ask_id = ' . $id); 
		$pagination = new CPagination( $askThreadModel->count( $criteria ));
		$pagination->pageSize = 10;
		$criteria->order = 'id asc';
		$pagination->applyLimit( $criteria );
		$threadList = $askThreadModel->findAll($criteria); 
		
		$this->render('show',array('askModel'=> $askModel, 
								   'categories' => $categories,
								   'askThreadModel' => $askThreadModel,
								   'threadList' => $threadList,
								   'pager'=>$pagination, 
		));
	}
	
	// Delete ask thread
	public function actionDel()
	{
		$askThreadModel = new AskThread;
		$id = $_GET['id'];
		
		if (empty($id)) {
			throw new CHttpException(404, 'The page cannot be found.');
		}

		$askThreadModel = $askThreadModel->findByPk($id);
		
		if (empty($askModel->id) || ($askModel->user_id != Yii::app()->user->id) ) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		
		$askId = $askThreadModel->ask_id;
		$askThreadModel->delete();
		
		$this->redirect(Yii::app()->createUrl('/ask/show', array('id' => $askId) ));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}