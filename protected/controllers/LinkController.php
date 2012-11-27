<?php

class LinkController extends Controller
{
	public function actionIndex()
	{
		$linkModel = new Link;
		
		$result = $linkModel->AtoZ()->findAll();
		
		$this->render('index',array('data'=> $result,)
		);  
	}

}