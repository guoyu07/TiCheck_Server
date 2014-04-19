<?php

/**
 * This is the model class for table "Subscription".
 *
 * The followings are the available columns in table 'Subscription':
 * @property string $ID
 * @property string $DepartCity
 * @property string $ArriveCity
 * @property string $StartDate
 * @property string $EndDate
 * @property integer $CurrentPrice
 * @property string $EarliestDepartTime
 * @property string $LatestDepartTime
 * @property string $AirlineDibitCode
 * @property string $ArriveAirport
 * @property string $DepartAirport
 *
 * The followings are the available model relations:
 * @property HistoryPrice[] $historyPrices
 * @property UserSubscription[] $userSubscriptions
 */
class Subscription extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Subscription';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DepartCity, ArriveCity, StartDate, EndDate, CurrentPrice', 'required'),
			array('CurrentPrice', 'numerical', 'integerOnly'=>true),
			array('DepartCity, ArriveCity, ArriveAirport, DepartAirport', 'length', 'max'=>3),
			array('AirlineDibitCode', 'length', 'max'=>2),
			array('EarliestDepartTime, LatestDepartTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, DepartCity, ArriveCity, StartDate, EndDate, CurrentPrice, EarliestDepartTime, LatestDepartTime, AirlineDibitCode, ArriveAirport, DepartAirport', 'safe', 'on'=>'search'),
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
			'historyPrices' => array(self::HAS_MANY, 'HistoryPrice', 'ID_subscription'),
			'userSubscriptions' => array(self::HAS_MANY, 'UserSubscription', 'ID_subscription'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'DepartCity' => 'Depart City',
			'ArriveCity' => 'Arrive City',
			'StartDate' => 'Start Date',
			'EndDate' => 'End Date',
			'CurrentPrice' => 'Current Price',
			'EarliestDepartTime' => 'Earliest Depart Time',
			'LatestDepartTime' => 'Latest Depart Time',
			'AirlineDibitCode' => 'Airline Dibit Code',
			'ArriveAirport' => 'Arrive Airport',
			'DepartAirport' => 'Depart Airport',
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
		$criteria->compare('DepartCity',$this->DepartCity,true);
		$criteria->compare('ArriveCity',$this->ArriveCity,true);
		$criteria->compare('StartDate',$this->StartDate,true);
		$criteria->compare('EndDate',$this->EndDate,true);
		$criteria->compare('CurrentPrice',$this->CurrentPrice);
		$criteria->compare('EarliestDepartTime',$this->EarliestDepartTime,true);
		$criteria->compare('LatestDepartTime',$this->LatestDepartTime,true);
		$criteria->compare('AirlineDibitCode',$this->AirlineDibitCode,true);
		$criteria->compare('ArriveAirport',$this->ArriveAirport,true);
		$criteria->compare('DepartAirport',$this->DepartAirport,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Subscription the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
