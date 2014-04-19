<?php

/**
 * This is the model class for table "User_Subscription".
 *
 * The followings are the available columns in table 'User_Subscription':
 * @property integer $ID
 * @property string $ID_user
 * @property string $ID_subscription
 * @property integer $PriceLimit
 *
 * The followings are the available model relations:
 * @property TiUser $iDUser
 * @property Subscription $iDSubscription
 */
class UserSubscription extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'User_Subscription';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_user, ID_subscription', 'required'),
			array('PriceLimit', 'numerical', 'integerOnly'=>true),
			array('ID_user, ID_subscription', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, ID_user, ID_subscription, PriceLimit', 'safe', 'on'=>'search'),
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
			'iDUser' => array(self::BELONGS_TO, 'TiUser', 'ID_user'),
			'iDSubscription' => array(self::BELONGS_TO, 'Subscription', 'ID_subscription'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'ID_user' => 'Id User',
			'ID_subscription' => 'Id Subscription',
			'PriceLimit' => 'Price Limit',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('ID_user',$this->ID_user,true);
		$criteria->compare('ID_subscription',$this->ID_subscription,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserSubscription the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
