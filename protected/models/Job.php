<?php

/**
 * This is the model class for table "z_job".
 *
 * The followings are the available columns in table 'z_job':
 * @property integer $id
 * @property integer $category_id
 * @property integer $city_id
 * @property string $title
 * @property string $content
 * @property string $email
 * @property string $company
 * @property string $created_at
 * @property integer $created_by
 */
class Job extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Job the static model class
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
		return 'z_job';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, city_id, type, title, content, email, company', 'required'),
			array('category_id, city_id, created_by', 'numerical', 'integerOnly'=>true),
			array('title, email, company', 'length', 'max'=>255),
			array('email', 'filter', 'filter'=>'trim'),
			array('email', 'email'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_id, city_id, title, content, email, company, created_at, created_by', 'safe', 'on'=>'search'),
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
			'city'=>array(self::BELONGS_TO, 'Region', 'city_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Category',
			'city_id' => 'Job Location',
			'type' => 'Job Type',
			'title' => 'Title',
			'content' => 'Job Description',
			'email' => 'Email',
			'company' => 'Employer',
			'created_at' => 'Created At',
			'created_by' => 'Created By',
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
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('created_by',$this->created_by);

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