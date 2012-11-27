<?php

class MessageController extends Controller
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
	            'actions'=>array('new','delete', 'show', 'index', 'chat'),
	            'users'=>array('?'),
	        ),
        );
    }
    
	public function actionDel()
	{
		$messageThreadModel=new MessageThread;
		$id = $_GET['id'];
		
		if (empty($id)) {
			throw new CHttpException(404, 'The page cannot be found.');
		}

		$messageThreadModel = $messageThreadModel->findByPk($id);
		
		if (empty($messageThreadModel->id) || ($messageThreadModel->user_id != Yii::app()->user->id)) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$messageId = $messageThreadModel->message_id;
		
		// Delete message thread
		$messageThreadModel->delete();
		
		$threadExists = $messageThreadModel->exists('message_id = :message_id', 
													array(':message_id'=>$messageId));
		
		// Delete message
		if (!$threadExists) {
			Message::model()->deleteByPk($messageId);
			$this->redirect(Yii::app()->createUrl('/message' ));
		}
		
		// $this->redirect(Yii::app()->createUrl('/message/show', array('id' => $messageId) ));
		$this->redirect($_SERVER['HTTP_REFERER']);
	}

	public function actionIndex()
	{
		$messageModel=new Message;
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('to_id = ' . Yii::app()->user->id . ' or from_id = ' . Yii::app()->user->id); 
		$pagination = new CPagination( $messageModel->count( $criteria ));
		$pagination->pageSize = 20;
		$criteria->order = 'id desc';
		$pagination->applyLimit( $criteria );
		$result = $messageModel->findAll($criteria); 
		
		
		$this->render('index',array('data'=>$result,
									'pager'=>$pagination,
									'currentBox' => 'in',
									'count' => count($result))
		);  
	}

	// Send Message
	public function actionNew()
	{
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		$to_id = trim($_GET['id']);

		$userModel=User::Model()->findByPk($to_id);
		
		if (empty($userModel->id)) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$messageModel=new Message;
		
		// Save new message
	    if(isset($_POST['Message']))
	    {
	        $messageModel->attributes=$_POST['Message'];
	        if($messageModel->validate())
	        {
	        	// Message
	            $messageModel->created_at = date('Y-m-d H:i:s');
	            $messageModel->from_id = Yii::app()->user->id;
	            $messageModel->save();
	            $messageId = $messageModel->getPrimaryKey();
	            
	            // Thread
				$messageThreadModel=new MessageThread;
				$messageThreadModel->message_id = $messageId;
				$messageThreadModel->user_id = Yii::app()->user->id;
				$messageThreadModel->content = $messageModel->content;
				$messageThreadModel->from_status = 1;
				$messageThreadModel->to_status = 0;
				$messageThreadModel->created_at = date('Y-m-d H:i:s');
				$messageThreadModel->save();
				
				$this->redirect(Yii::app()->createUrl('/message' ));
	        }
	    }
	    
	    $this->render('new',array('model' => $messageModel,
	    						  'userModel' => $userModel,
	    						  'to_id' => $to_id
	    ));
	}
	
	public function actionShow()
	{
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		$id = trim($_GET['id']);
		
		$messageModel=Message::Model()->findByPk($id);
		
		if (empty($messageModel->id)) {
			throw new CHttpException(404, 'The page cannot be found.');
		}
		
		$pageSize = 20;
		
		// Message thread
		$messageThreadModel=new MessageThread;
		
		// Reply
		if(isset($_POST['MessageThread']) && (Yii::app()->user->id > 0))
	    {
	        $messageThreadModel->attributes=$_POST['MessageThread'];
	        if($messageThreadModel->validate())
	        {
				$messageThreadModel->message_id = $id;
				$messageThreadModel->user_id = Yii::app()->user->id;
				$messageThreadModel->content = $messageThreadModel->content;
				if (Yii::app()->user->id == $messageModel->from_id) {
					$messageThreadModel->from_status = 1;
					$messageThreadModel->to_status = 0;
				} else {
					$messageThreadModel->from_status = 0;
					$messageThreadModel->to_status = 1;
				}
				
				$messageThreadModel->created_at = date('Y-m-d H:i:s');
				
				$messageThreadModel->save();
				
				$n = $messageThreadModel->count();
				$lastPage = ceil($n / $pageSize);
				$this->redirect(Yii::app()->createUrl('/message/show/', array('id' => $id, 'page' => $lastPage) ));
	        }
	    }
	    
	    // Message thread list
	    $criteria = new CDbCriteria();
		$criteria->addCondition('message_id = ' . $id); 
		$pagination = new CPagination( $messageThreadModel->count( $criteria ));
		$pagination->pageSize = $pageSize;
		$criteria->order = 'id asc';
		$pagination->applyLimit( $criteria );
		$threadList = $messageThreadModel->findAll($criteria); 
		
		// print_r($pagination); die();
		$this->render('show',array('messageModel'=> $messageModel,
								   'messageThreadModel' => $messageThreadModel,
								   'threadList' => $threadList,
								   'pager'=>$pagination, 
		));
		
	}
	
	public function setReadable($threadList, $currentStatus)
	{
		foreach ($threadList as $k => $v) {
			$messageThreadModel = MessageThread::model()->findByPk($v->id);
			$messageThreadModel->$currentStatus = 1;
			$messageThreadModel->save();
			unset($messageThreadModel);
		}
		return;
	}
	
	
	public function actionChat()
	{
		$this->redirect(Yii::app()->createUrl('/web/chat/flashchat.php?username=' . 
								Yii::app()->user->username . '' ));
	}

}