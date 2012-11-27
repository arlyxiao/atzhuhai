<?php

/**
 * This is the model class for table "z_ask".
 *
 * The followings are the available columns in table 'z_ask':
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $title
 * @property string $content
 * @property string $created_at
 */
class Ask extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Ask the static model class
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
		return 'z_ask';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, title, content', 'required'),
			array('user_id, category_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('title', 'length', 'min'=>5),
			array('content', 'length', 'min'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, category_id, title, content, created_at', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'category_id' => 'Category',
			'title' => 'Title',
			'content' => 'Content',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function scopes()
    {
        return array(
            'recently'=>array(
                'order'=>'id DESC',
                'limit'=>8,
            ),
        );
    }
    
	public function countThread($askId)
	{
		$n = AskThread::model()->count('ask_id=:ask_id', 
										   array(':ask_id' => $askId));
										   
		return $n;
	}
}