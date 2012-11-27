<?php

class HomeController extends Controller
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
            array('allow',
                'actions'=>array('signin', 'signup'),
                'users'=>array('?'),
            ),
            array('deny',
                'actions'=>array('signin', 'signup'),
                'users'=>array('@'),
            ),
        );
    }
    
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}
    
	public function actionIndex()
	{
		// Events
		$events = Event::model()->recently()->findAll();
		
		// Articles
		// $articleCategories = Category::model()->article()->findAll();
		
		// $articles = Article::model()->with('categories')->recently()->findAll();
		// print_r($articles); die();
		
		// Top Articles
		$articles = ArticleTop::model()->recently()->findAll();
		//print_r($articles); die();
		
		$askList = Ask::model()->recently()->findAll();
		
		$classifiedList = Classified::model()->recently()->findAll();
		
		// Job list
		$jobList = Job::model()->recently()->findAll();
		
		//Blog list
		$blogList = Blog::model()->recently()->findAll();
		
		$this->render('index', array('events' => $events, 
									 'jobList' => $jobList,
									 'articles' => $articles,
									// 'articleCategories' => $articleCategories,
									 'askList' => $askList,
									 'classifiedList' => $classifiedList,
									 'blogList' => $blogList
		)
		);
	}

	public function actionSignin()
	{
		$model=new User('signin');
	
	    if(isset($_POST['User']))
	    {
	        $model->attributes=$_POST['User'];
	        if($model->validate())
	        {
	        	// $password = md5($_POST['User']['password']);
	        	$password = $_POST['User']['password'];
	            $identity=new UserIdentity($_POST['User']['email'], $password);
				if($identity->authenticate()) {
				    Yii::app()->user->login($identity);
				    $returnUrl = str_replace('index.php', '', Yii::app()->user->returnUrl);
				    Yii::app()->request->redirect($returnUrl);
				} else {
				    echo $identity->errorMessage;
				}
	        }
	    }
	    $this->render('signin',array('model'=>$model));
	}
	
	
	public function actionSignup()
	{
		$userModel=new User('signup');
	
	    if(isset($_POST['User']))
	    {
	        $userModel->attributes=$_POST['User'];
	        if($userModel->validate())
	        {
	        	// Signup
				$userModel->created_at = date('Y-m-d H:i:s');
				$userModel->password = md5($_POST['User']['password']);
				$userModel->save();
				
				// Signin
				$identity=new UserIdentity($_POST['User']['email'], $_POST['User']['password']);
	        	if($identity->authenticate()) {
				    Yii::app()->user->login($identity);
				    $this->redirect(Yii::app()->getBaseUrl(true));
				} else {
				    echo $identity->errorMessage;
				}
	        }
	    }
	    $this->render('signup',array('model'=>$userModel));
	}
	
	public function actionSignout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}