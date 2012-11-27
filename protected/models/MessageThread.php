<?php

/**
 * This is the model class for table "z_message_thread".
 *
 * The followings are the available columns in table 'z_message_thread':
 * @property integer $id
 * @property integer $message_id
 * @property integer $user_id
 * @property string $content
 * @property integer $from_status
 * @property integer $to_status
 * @property string $created_at
 */
class MessageThread extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return MessageThread the static model class
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
		return 'z_message_thread';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content', 'required'),
			array('message_id, user_id, from_status, to_status', 'numerical', 'integerOnly'=>true),
			array('content', 'length', 'min'=>5),
			// Please remove those attributes that should not be searched.
			array('id, message_id, user_id, content, from_status, to_status, created_at', 'safe', 'on'=>'search'),
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
			'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'message_id' => 'Message',
			'user_id' => 'User',
			'content' => 'Content',
			'from_status' => 'From Status',
			'to_status' => 'To Status',
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
		$criteria->compare('message_id',$this->message_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('from_status',$this->from_status);
		$criteria->compare('to_status',$this->to_status);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}