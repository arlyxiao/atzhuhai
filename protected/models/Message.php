<?php

/**
 * This is the model class for table "z_message".
 *
 * The followings are the available columns in table 'z_message':
 * @property integer $id
 * @property integer $from_id
 * @property integer $to_id
 * @property string $content
 * @property string $created_at
 */
class Message extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Message the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'z_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('to_id, title, content', 'required'),
			array('from_id, to_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'min'=>3),
			array('content', 'length', 'min'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, from_id, to_id, title, created_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'toUser'=>array(self::BELONGS_TO, 'User', 'to_id'),
			'fromUser'=>array(self::BELONGS_TO, 'User', 'from_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'from_id' => 'From',
			'to_id' => 'To',
			'title' => 'Subject',
			'content' => 'Message',
			'created_at' => 'Created At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('from_id',$this->from_id);
		$criteria->compare('to_id',$this->to_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function countUnreadThread($messageId, $fromId)
	{
		if (Yii::app()->user->id == $fromId) {
			$condition = ' and from_status = 0';
		} else {
			$condition = ' and to_status = 0';
		}
		$n = MessageThread::model()->count('message_id=:message_id' . $condition, 
										   array(':message_id' => $messageId));
										   
		return $n;
	}
	
	public function countUnreadMessage()
	{
		$data = $this->findAll('from_id = :user_id or to_id = :user_id', 
					   array(':user_id' => Yii::app()->user->id));
		
		$total = '';
		foreach ($data as $k => $v) {
			$total = $total + $this->countUnreadThread($v->id, $v->from_id);
		}
		return $total;
	}
}