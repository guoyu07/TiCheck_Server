<?php

/**
 * This is the model class for table "TiUser".
 *
 * The followings are the available columns in table 'TiUser':
 * @property string $ID
 * @property string $Account
 * @property string $Password
 * @property string $Email
 * @property string $Timestamp
 * @property integer $Pushable
 * @property string $UID
 *
 * The followings are the available model relations:
 * @property Contacts[] $contacts
 * @property Order[] $orders
 * @property UserDevice[] $userDevices
 * @property UserSubscription[] $userSubscriptions
 */
class TiUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TiUser';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Password, Email, Timestamp', 'required'),
			array('Pushable', 'numerical', 'integerOnly'=>true),
			array('Account, Password', 'length', 'max'=>64),
			array('Email', 'length', 'max'=>320),
			array('UID', 'length', 'max'=>40),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Account, Password, Email, Timestamp, Pushable, UID', 'safe', 'on'=>'search'),
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
			'contacts' => array(self::HAS_MANY, 'Contacts', 'ID_user'),
			'orders' => array(self::HAS_MANY, 'Order', 'ID_user'),
			'userDevices' => array(self::HAS_MANY, 'UserDevice', 'ID_user'),
			'userSubscriptions' => array(self::HAS_MANY, 'UserSubscription', 'ID_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Account' => 'Account',
			'Password' => 'Password',
			'Email' => 'Email',
			'Timestamp' => 'Timestamp',
			'Pushable' => 'Pushable',
			'UID' => 'Uid',
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('Account',$this->Account,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Timestamp',$this->Timestamp,true);
		$criteria->compare('Pushable',$this->Pushable);
		$criteria->compare('UID',$this->UID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TiUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
