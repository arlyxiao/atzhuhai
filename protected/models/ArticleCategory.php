<?php

/**
 * This is the model class for table "z_article_category".
 *
 * The followings are the available columns in table 'z_article_category':
 * @property integer $id
 * @property integer $article_id
 * @property integer $category_id
 */
class ArticleCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ArticleCategory the static model class
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
		return 'z_article_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article_id, category_id', 'required'),
			array('article_id, category_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, article_id, category_id', 'safe', 'on'=>'search'),
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
			'article'=>array(self::HAS_ONE, 'Article', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'article_id' => 'Article',
			'category_id' => 'Category',
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
		$criteria->compare('article_id',$this->article_id);
		$criteria->compare('category_id',$this->category_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function category($categoryId)
	{
	    $this->getDbCriteria()->mergeWith(array(
	        'condition'=>'category_id=' . $categoryId,
	    ));
	    return $this;
	}
	
	/**
	public function scopes()
    {
        return array(
            'category'=>array(
                'condition'=>'category_id=' . $categoryId,
            ),
        );
    }
    **/
}