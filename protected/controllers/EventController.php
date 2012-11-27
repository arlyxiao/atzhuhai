<?php

class EventController extends Controller
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
	            'actions'=>array('new','edit'),
	            'users'=>array('?'),
	        ),
        );
    }
    
	public function actionDelete()
	{
		$this->render('delete');
	}
	
	public function actionShow()
	{
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		$id = trim($_GET['id']);
		
		$eventModel=Event::Model()->findByPk($id);
		
		if (empty($eventModel->id)) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$this->pageTitle = Yii::app()->name . ' - ' .$eventModel->title;
		
		$categories = Category::model()->event()->findAll();;
		
		$this->render('show',array('eventModel'=> $eventModel, 'categories' => $categories));
	}

	public function actionEdit()
	{
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		$id = trim($_GET['id']);
		$eventModel=new Event('edit');
		$eventModel = $eventModel->find(array(
		    'condition'=>'id=:id',
		    'params'=>array(':id' => $id),
		));
		if (empty($eventModel->id)) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$currentAvatar = $eventModel->avatar;
		
		if ( empty($eventModel->id) || ($eventModel->user_id != Yii::app()->user->id) ) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		if(isset($_POST['Event'])) {
			// print_r($_FILES); die();
			$eventModel->attributes=$_POST['Event'];
			
			if ($_FILES['Event']['size']['avatar'] > 0) {
				$eventAvatarDir = Yii::app()->params['eventAvatarDir'];
			    $eventModel->avatar = CUploadedFile::getInstance($eventModel, 'avatar');
			    
				$newFileName = time() . '_' . $eventModel->avatar;
		    	$eventModel->avatar->saveAs($eventAvatarDir . $newFileName);
		    	$eventModel->avatar = $newFileName;
			} else {
				$eventModel->avatar = $currentAvatar;
			}
	    	
			if ($eventModel->validate()) {
				$eventModel->save();
				$this->redirect(Yii::app()->createUrl('/event/show', array('id' => $eventModel->id) ));
			}
			
		}
		
		// Cities
		$cities = $this->dropCities();
		
		// Areas
		$defaultAreas = $this->dropAreas($eventModel->city_id);
		
		// Event Categories
		$categories = $this->eventDropCategories();
		
		$this->render('edit',array('model'=>$eventModel, 
								  'categories' => $categories,
								  'pageStatus' => 'edit', 
								  'cities' => $cities,
								  'defaultAreas' => $defaultAreas)
		);
	}

	public function actionIndex()
	{
		$eventModel = new Event;
		
		$criteria = new CDbCriteria();
		// $criteria->addCondition(....); 
		$pagination = new CPagination( $eventModel->count( $criteria ));
		$pagination->pageSize = 20;
		$criteria->order = 'id desc';
		$pagination->applyLimit( $criteria );
		$result = $eventModel->findAll($criteria); 
		
		$categories = Category::model()->event()->findAll();;
		
		$this->render('index',array('data'=>$result,
									'pager'=>$pagination, 
									'categories' => $categories)
		);  
	}
	
	public function actionCategory()
	{
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$category_id = trim($_GET['id']);
		$currentCategory = Category::model()->findByPk($category_id);
		
		$eventModel = new Event;
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('category_id = ' . $category_id); 
		$pagination = new CPagination( $eventModel->count( $criteria ));
		$pagination->pageSize = 20;
		$criteria->order = 'id desc';
		$pagination->applyLimit( $criteria );
		$result = $eventModel->findAll($criteria); 
		
		$categories = Category::model()->event()->findAll();
		
		$this->pageTitle = Yii::app()->name . ' - ' .$currentCategory->name;
		
		$this->render('index',array('data'=>$result,
									'pager'=>$pagination, 
									'categories' => $categories)
		);  
	}
	
	public function actionAreas()
	{
		$parent_id = $_POST['city_id'];
		
		$regionModel = new Region;
		$data = $regionModel->findAll(array(
			'select'=>'name_en',
		    'condition'=>'type=:type and parent_id=:parent_id',
		    'params'=>array(':type' => 'area', ':parent_id' => $parent_id),
		));
		
		foreach ($data as $c) {
			echo CHtml::tag('option',array('value'=>$c->id),CHtml::encode($c->name_en),true);
		}
	}

	public function actionNew()
	{
		
		$eventModel=new Event('new');
	    if(isset($_POST['Event']))
	    {
	        $eventModel->attributes=$_POST['Event'];
	        $eventAvatarDir = Yii::app()->params['eventAvatarDir'];
		    $eventModel->avatar = CUploadedFile::getInstance($eventModel, 'avatar');
	        if($eventModel->validate())
	        {
	        	// Event photo name
		    	$newFileName = time() . '_' . $eventModel->avatar;
		    	$eventModel->avatar->saveAs($eventAvatarDir . $newFileName);
		    	$eventModel->avatar = $newFileName;
		    	
		    	// Created time
		    	$eventModel->created_at = date('Y-m-d H:i:s');
		    	
		    	// User Id
		    	$eventModel->user_id = Yii::app()->user->id;
		    	
		    	// Save
	            if($eventModel->save())
	            {
	                $this->redirect(Yii::app()->createUrl('/event'));
	            }
	        }
	    }
	    
	    // Cities
		$cities = $this->dropCities();
		
		// Areas
		$defaultAreas = $this->dropAreas();
		
		// Event categories
	    $categories = $this->eventDropCategories();
	    
	    $this->render('new',array('model'=>$eventModel, 
	    						  'cities' => $cities, 
	    						  'categories' => $categories,
	    						  'defaultAreas' => $defaultAreas));
	}
	
	// Event categories for drop down list
	private function eventDropCategories()
	{
		$categoryModel = new Category;
		$categoryList = $categoryModel->findAll(array(
			'select'=>'id, name',
		    'condition'=>'type=:type',
		    'params'=>array(':type' => 'event'),
		));
		
		$categories = array('' => '--Select--');
		foreach ($categoryList as $k => $c) {
			$categories[$c->id] = $c->name;
		}
		
		return $categories;
	}
	
	private function dropCities()
	{
		$regionModel = new Region;
		$cityList = $regionModel->findAll(array(
			'select'=>'id, name_en',
		    'condition'=>'type=:type',
		    'params'=>array(':type' => 'city'),
		));
		
		$cities = array();
		foreach ($cityList as $k => $c) {
			$cities[$c->id] = $c->name_en;
		}
		
		return $cities;
	}
	
	private function dropAreas($cityId = 4)
	{
		$regionModel = new Region;
		$areaList = $regionModel->findAll(array(
			'select'=>'id, name_en',
		    'condition'=>'type=:type and parent_id=:parent_id',
		    'params'=>array(':type' => 'area', 'parent_id' => $cityId),
		));
		
		$defaultAreas = array();
		foreach ($areaList as $k => $a) {
			$defaultAreas[$a->id] = $a->name_en;
		}
		
		return $defaultAreas;
	}
}