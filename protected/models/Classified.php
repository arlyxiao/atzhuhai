<?php

/**
 * This is the model class for table "z_classified".
 *
 * The followings are the available columns in table 'z_classified':
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $content
 * @property string $avatar
 * @property string $url
 * @property string $created_at
 */
class Classified extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Classified the static model class
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
		return 'z_classified';
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
			array('title', 'length', 'min'=>3),
			array('content', 'length', 'min'=>10),
			array('avatar', 'file', 'allowEmpty' => true, 'types' => 'jpg, jpeg, gif, png'),
			array('web_url', 'url', 'allowEmpty' => true),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('title, contact, tel, avatar, web_url', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, title, contact, tel, content, avatar, url, created_at', 'safe', 'on'=>'search'),
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
			'category'=>array(self::BELONGS_TO, 'Category', 'category_id'),
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
			'contact' => 'Contact',
			'tel' => 'Tel',
			'content' => 'Description',
			'avatar' => 'Photo',
			'web_url' => 'Web Url',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('web_url',$this->web_url,true);
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
}