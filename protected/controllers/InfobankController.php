<?php

class InfobankController extends Controller
{
	public function actionIndex()
	{
		$articleModel = new Article;
		
		$criteria = new CDbCriteria();
		// $criteria->addCondition(....); 
		$pagination = new CPagination( $articleModel->count( $criteria ));
		$pagination->pageSize = 20;
		$criteria->order = 'id desc';
		$pagination->applyLimit( $criteria );
		$result = $articleModel->findAll($criteria); 
		
		$categories = Category::model()->article()->findAll();;
		
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
		
		$categoryId = trim($_GET['id']);
		
		$currentCategory = Category::model()->findByPk($categoryId);

		$articleModel = new Article;
		
		$criteria = new CDbCriteria();
		$criteria->join = 'LEFT JOIN z_article_category ac ON t.id = ac.article_id';
		$criteria->addCondition('ac.category_id = :categoryId'); 
		$criteria->params = array(':categoryId' => $categoryId);
	
		$pagination = new CPagination( $articleModel->count( $criteria ));
		$pagination->pageSize = 20;
		$criteria->order = 'id desc';
		$pagination->applyLimit( $criteria );
		
		$result = $articleModel->findAll($criteria);

		$categories = Category::model()->article()->findAll();;
		
		$this->render('index',array('data'=>$result,
									'currentCategory' => $currentCategory,
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
		
		$articleModel=Article::Model()->findByPk($id);
		
		if (empty($articleModel->id)) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$categories = Category::model()->article()->findAll();;
		
		$this->render('show',array('articleModel'=> $articleModel, 'categories' => $categories));
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