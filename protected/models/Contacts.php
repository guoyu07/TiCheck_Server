<?php

/**
 * This is the model class for table "Contacts".
 *
 * The followings are the available columns in table 'Contacts':
 * @property string $ID
 * @property string $PassengerName
 * @property string $ContactTelephone
 * @property string $ID_user
 * @property string $Birthday
 * @property string $PassType
 * @property string $PassportNumber
 * @property string $Gender
 *
 * The followings are the available model relations:
 * @property TiUser $iDUser
 */
class Contacts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Contacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PassengerName, ContactTelephone, ID_user, PassType, PassportNumber, Gender', 'required'),
			array('PassengerName, ContactTelephone, ID_user', 'length', 'max'=>20),
			array('PassType', 'length', 'max'=>3),
			array('PassportNumber', 'length', 'max'=>100),
			array('Gender', 'length', 'max'=>1),
			array('Birthday', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, PassengerName, ContactTelephone, ID_user, Birthday, PassType, PassportNumber, Gender', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'PassengerName' => 'Passenger Name',
			'ContactTelephone' => 'Contact Telephone',
			'ID_user' => 'Id User',
			'Birthday' => 'Birthday',
			'PassType' => 'Pass Type',
			'PassportNumber' => 'Passport Number',
			'Gender' => 'Gender',
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
		$criteria->compare('PassengerName',$this->PassengerName,true);
		$criteria->compare('ContactTelephone',$this->ContactTelephone,true);
		$criteria->compare('ID_user',$this->ID_user,true);
		$criteria->compare('Birthday',$this->Birthday,true);
		$criteria->compare('PassType',$this->PassType,true);
		$criteria->compare('PassportNumber',$this->PassportNumber,true);
		$criteria->compare('Gender',$this->Gender,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contacts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
