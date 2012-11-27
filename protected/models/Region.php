<?php

/**
 * This is the model class for table "z_region".
 *
 * The followings are the available columns in table 'z_region':
 * @property integer $id
 * @property string $name_en
 * @property string $name_cn
 * @property integer $parent_id
 * @property string $type
 */
class Region extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Region the static model class
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
		return 'z_region';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_en, name_cn, parent_id, type', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('name_en, name_cn', 'length', 'max'=>50),
			array('type', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name_en, name_cn, parent_id, type', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name_en' => 'Name En',
			'name_cn' => 'Name Cn',
			'parent_id' => 'Parent',
			'type' => 'Type',
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
		$criteria->compare('name_en',$this->name_en,true);
		$criteria->compare('name_cn',$this->name_cn,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function scopes()
    {
        return array(
        	'city'=>array(
                'condition'=>'type="city"',
            ),
           
        );
    }
}