<?php

class JobController extends Controller
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
    
	public function actionCategory()
	{
		$this->pageTitle = 'At Zhuhai | Job in Zhuhai, job in Guangdong';
		
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$category_id = trim($_GET['id']);
		
		$currentCategory = Category::model()->findByPk($category_id);

		$jobModel=new Job;
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('category_id = ' . $category_id); 
		$pagination = new CPagination( $jobModel->count( $criteria ));
		$pagination->pageSize = 20;
		$criteria->order = 'id desc';
		$pagination->applyLimit( $criteria );
		$result = $jobModel->findAll($criteria); 
		
		$categories = Category::model()->job()->findAll();
		
		$this->render('index',array('data'=>$result,
									'currentCategory' => $currentCategory,
									'pager'=>$pagination, 
									'count' => count($result),
									'categories' => $categories)
		);
	}

	public function actionIndex()
	{
		$this->pageTitle = 'At Zhuhai | Job in Zhuhai, job in Guangdong';
		
		$jobModel = new Job;
		
		$criteria = new CDbCriteria();
		$pagination = new CPagination( $jobModel->count( $criteria ));
		$pagination->pageSize = 20;
		$criteria->order = 'id desc';
		$pagination->applyLimit( $criteria );
		$result = $jobModel->findAll($criteria); 
		
		$categories = Category::model()->job()->findAll();;
		
		$this->render('index',array('data'=>$result,
									'pager'=>$pagination, 
									'categories' => $categories)
		);  
	}

	public function actionShow()
	{
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		$id = trim($_GET['id']);
		
		$jobModel=Job::Model()->findByPk($id);
		
		if (empty($jobModel->id)) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$categories = Category::model()->job()->findAll();;
		
		$this->render('show',array('jobModel'=> $jobModel, 'categories' => $categories));
	}
	
	public function actionNew()
	{
		$jobModel = new Job;
		
		// Save new job
	    if(isset($_POST['Job']))
	    {
	        $jobModel->attributes=$_POST['Job'];
	        if($jobModel->validate())
	        {
	            $jobModel->created_at = date('Y-m-d H:i:s');
	            $jobModel->created_by = Yii::app()->user->id;
	            $jobModel->save();
				$id = $jobModel->getPrimaryKey();
				
				$this->redirect(Yii::app()->createUrl('/job/show/', array('id' => $id) ));
	        }
	    }
	    
	    // Job categories
	    $categories = Category::model()->job()->findAll();
	    $dropDownCategories = CHtml::listData($categories, 'id', 'name');
	    
	    // Cities
	    $cities = Region::model()->city()->findAll();
	    $dropDownCities = CHtml::listData($cities, 'id', 'name_en');
	    
	    $this->render('new',array('model'=>$jobModel, 
	    						  'categories' => $categories,
	    						  'dropDownCities' => $dropDownCities,
	    						  'dropDownCategories' => $dropDownCategories
	    ));
	}

	public function actionEdit()
	{
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		$id = trim($_GET['id']);
	
		$jobModel=Job::Model()->findByPk($id);
		
		if (empty($jobModel->id) || ($jobModel->created_by != Yii::app()->user->id) ) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		// Save jov
	    if(isset($_POST['Job']))
	    {
	        $jobModel->attributes=$_POST['Job'];
	        if($jobModel->validate())
	        {
	            $jobModel->updated_at = date('Y-m-d H:i:s');
	            $jobModel->save();

				$this->redirect(Yii::app()->createUrl('/job/show/', array('id' => $id) ));
	        }
	    }
	    
	    // Job categories
	    $categories = Category::model()->job()->findAll();
	    $dropDownCategories = CHtml::listData($categories, 'id', 'name');
	    
	    // Cities
	    $cities = Region::model()->city()->findAll();
	    $dropDownCities = CHtml::listData($cities, 'id', 'name_en');
	    
	    $this->render('new',array('model'=>$jobModel, 
	    						  'categories' => $categories,
	    						  'dropDownCities' => $dropDownCities,
	    						  'dropDownCategories' => $dropDownCategories
	    ));
	}

	public function actionDelete()
	{
		$jobModel = new Job;
		$id = $_GET['id'];
		
		if (empty($id)) {
			throw new CHttpException(404, 'The page cannot be found.');
		}

		$jobModel = $jobModel->findByPk($id);
		
		if (empty($jobModel->id) || ($jobModel->created_by != Yii::app()->user->id) ) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$jobModel->delete();
		
		$this->redirect(Yii::app()->createUrl('/job' ));
	}
 
}