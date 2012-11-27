<?php

class ArticleController extends Controller
{
	public function actionDelete()
	{
		$articleModel = new Article;
		$id = $_GET['id'];
		
		$articleModel = $articleModel->findByPk($id);
		$articleModel->delete();
		
		$this->redirect(Yii::app()->createUrl('/admin/article'));
		
	}


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

	public function actionNew()
	{
		$articleModel=new Article;
		
		if(isset($_POST['Article']))
	    {
	        $articleModel->attributes=$_POST['Article'];
	        if($articleModel->validate())
	        {
	            $articleModel->created_at = date('Y-m-d H:i:s');
	            $articleModel->user_id = Yii::app()->user->id;
				$articleModel->save();
				$id = $articleModel->getPrimaryKey();
				
				// Save article categories
				$this->saveArticleCategories($id, $_POST['categories']);
				
				$this->redirect(Yii::app()->createUrl('/admin/article/edit', array('id' => $id) ));
	        }
	    }
		
		// Article categories
	    $categories = $this->articleDropCategories();
	    
		$this->render('new', array('model'=>$articleModel, 'categories' => $categories));
	}
	
	public function actionEdit()
	{
		$id = trim($_GET['id']);
		$articleModel=Article::Model()->findByPk($id);
		
		if(isset($_POST['Article'])) {
			$articleModel->attributes=$_POST['Article'];
			$articleModel->save();
			
			// Save article categories
			$this->saveArticleCategories($id, $_POST['categories']);
			$this->redirect(Yii::app()->createUrl('/admin/article/edit', array('id' => $articleModel->id)));
		}

		// Categories
	    $categories = $this->articleDropCategories();
	    
	    // Article categories
	    $articleCategoryModel = new ArticleCategory;
	    $articleCategories = $articleCategoryModel->findAll(array(
		    'condition'=>'article_id=:article_id',
		    'params'=>array(':article_id' => $id),
		));
		
		$articleCategories = CHtml::listData($articleCategories, 'id', 'category_id');    
		
		// print_r($articleCategories);die();
	    
		$this->render('edit', array('model'=>$articleModel, 
									'categories' => $categories,
									'articleCategories' => $articleCategories));
	}
	
	
	public function actionTop()
	{
		$article_id = trim($_GET['article_id']);
		$articleTopModel = ArticleTop::model()->find('article_id=:article_id', 
												 array(':article_id'=>$article_id));
	    if (empty($articleTopModel)) {
			$articleTopModel = new ArticleTop;
		}
			
		if (isset($_POST['ArticleTop']))
	    {
	    	$articleTopDir = Yii::app()->params['articleTopDir'];
	    	@unlink($articleTopDir . $articleTopModel->avatar);
	    	
	    	$articleTopModel->attributes=$_POST['ArticleTop'];

	    	$articleTopModel->avatar = CUploadedFile::getInstance($articleTopModel, 'avatar');
	    	$newFileName = time() . '_' . $articleTopModel->avatar;
	    	$articleTopModel->avatar->saveAs($articleTopDir . $newFileName);
	    	$articleTopModel->avatar = $newFileName;
            if($articleTopModel->save())
            {
                $this->redirect(Yii::app()->createUrl('/admin/article/top', 
                									  array('article_id' => $article_id))  );
            }
	    } 
	    
		$this->render('top', array('model'=>$articleTopModel, 'article_id' => $article_id));
	}
	
	private function articleDropCategories()
	{
		$categoryModel = new Category;
		$categoryList = $categoryModel->findAll(array(
			'select'=>'id, name',
		    'condition'=>'type=:type',
		    'params'=>array(':type' => 'article'),
		));
		
		$categories = array();
		foreach ($categoryList as $k => $c) {
			$categories[$c->id] = $c->name;
		}
		
		return $categories;
	}
	
	// Save article categories
	private function saveArticleCategories($article_id, $categories)
	{
		$articleCategoryModel = new ArticleCategory;
		
		// Delete
		$articleCategoryModel->deleteAll(array(
			'condition'=>'article_id=:article_id',
    		'params'=>array(':article_id'=>$article_id),
		));
		
		// Add new
		foreach ($categories as $v) {
			$articleCategoryModel = new ArticleCategory;
			$articleCategoryModel->article_id = $article_id;
			$articleCategoryModel->category_id = $v;
			
			$articleCategoryModel->save();
		}
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