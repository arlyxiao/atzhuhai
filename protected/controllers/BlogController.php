<?php

class BlogController extends Controller
{
	public function actionIndex()
	{
		$blogModel=new Blog;
		
		$criteria = new CDbCriteria();
		$pagination = new CPagination( $blogModel->count( $criteria ));
		$pagination->pageSize = 20;
		$criteria->order = 'created_at desc';
		$pagination->applyLimit( $criteria );
		$result = $blogModel->findAll($criteria); 
		
		$authors = BlogUser::model()->findAll();
		
		$this->render('index',array('data'=>$result,
									'pager'=>$pagination, 
									'authors' => $authors)
		);  
	}
	
	public function actionAuthor()
	{
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$authorId = trim($_GET['id']);
		$blogModel=new Blog;
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('author_id = ' . $authorId); 
		$pagination = new CPagination( $blogModel->count( $criteria ));
		$pagination->pageSize = 20;
		$criteria->order = 'created_at desc';
		$pagination->applyLimit( $criteria );
		$result = $blogModel->findAll($criteria); 
		
		$authors = BlogUser::model()->findAll();
		
		// Current Author
		$blogUserModel=BlogUser::Model()->findByPk($authorId);
		
		$this->render('index',array('data'=>$result,
									'pager'=>$pagination, 
									'blogUserModel' => $blogUserModel,
									'authors' => $authors)
		);  
	}

	public function actionShow()
	{
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		$id = trim($_GET['id']);
		
		$blogModel=Blog::Model()->findByPk($id);
		
		if (empty($blogModel->id)) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		
		$this->pageTitle = Yii::app()->name . ' - ' .$blogModel->title;
		
		$authors = BlogUser::model()->findAll();;
		
		// Current Author
		$blogUserModel=BlogUser::Model()->findByPk($blogModel->author_id);
		
		$this->render('show',array('blogModel'=> $blogModel, 
								   'blogUserModel' => $blogUserModel,
								   'authors' => $authors));
	}
	
	public function actionMyself()
	{
		$this->render('myself');
	}
 
}