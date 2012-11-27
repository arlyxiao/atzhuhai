<?php

/**
 * This is the model class for table "z_event".
 *
 * The followings are the available columns in table 'z_event':
 * @property integer $id
 * @property integer $user_id
 * @property string $organizer
 * @property string $title
 * @property string $description
 * @property string $avatar
 * @property string $start_time
 * @property string $end_time
 * @property string $created_at
 */
class Event extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Event the static model class
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
		return 'z_event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('organizer, city_id, area_id, address, title, category_id, description, start_time, end_time', 'required'),
			array('avatar', 'required', 'on' => 'new'),
			// array('avatar', 'file', 'types'=>'jpg, jpeg, gif, png'),
			array('avatar', 'file', 'types' => 'jpg, jpeg, gif, png', 'on' => 'new'),
			array('avatar', 'file', 'allowEmpty' => true, 'types' => 'jpg, jpeg, gif, png', 'on' => 'edit'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('organizer, avatar, start_time, end_time', 'length', 'max'=>50),
			array('title', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('organizer, title, description, start_time, end_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
    {
        return array(
            'category'=>array(self::BELONGS_TO, 'Category', 'category_id'),
        	'city'=>array(self::BELONGS_TO, 'Region', 'city_id'),
        	'area'=>array(self::BELONGS_TO, 'Region', 'area_id'),
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
			'organizer' => 'Event Organizer',
			'city_id' => 'City',
			'area_id' => 'Area',
			'address' => 'Venue',
			'title' => 'Event Title',
			'category_id' => 'Category',
			'description' => 'Description',
			'avatar' => 'Event photo',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
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
		$criteria->compare('organizer',$this->organizer,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function scopes()
    {
        return array(
        /**
            'published'=>array(
                'condition'=>'status=1',
            ),
         **/
            'recently'=>array(
                'order'=>'start_time DESC',
                'limit'=>9,
            ),
        );
    }
}