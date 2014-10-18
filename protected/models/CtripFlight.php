<?php

/**
 * This is the model class for table "ctrip_Flight".
 *
 * The followings are the available columns in table 'ctrip_Flight':
 * @property string $ID
 * @property string $DepartCityCode
 * @property string $ArriveCityCode
 * @property string $TakeOffTime
 * @property string $ArriveTime
 * @property string $Flight
 * @property string $CraftType
 * @property string $AirlineCode
 * @property string $Class
 * @property string $SubClass
 * @property string $DisplaySubclass
 * @property string $Rate
 * @property string $Price
 * @property string $StandardPrice
 * @property string $ChildStandardPrice
 * @property string $BabyStandardPrice
 * @property string $MealType
 * @property string $AdultTax
 * @property string $BabyTax
 * @property string $ChildTax
 * @property string $AdultOilFee
 * @property string $BabyOilFee
 * @property string $ChildOilFee
 * @property string $DPortCode
 * @property string $APortCode
 * @property string $DPortBuildingID
 * @property string $APortBuildingID
 * @property string $StopTimes
 * @property string $Nonrer
 * @property string $Nonend
 * @property string $Nonref
 * @property string $Rernote
 * @property string $Endnote
 * @property string $Refnote
 * @property string $Remarks
 * @property string $TicketType
 * @property string $BeforeFlyDate
 * @property string $Quantity
 * @property string $PriceType
 * @property string $ProductType
 * @property string $ProductSource
 * @property string $InventoryType
 * @property string $RouteIndex
 * @property string $NeedApplyString
 * @property string $Recommend
 * @property string $RefundFeeFormulaID
 * @property string $CanUpGrade
 * @property string $CanSeparateSale
 * @property string $CanNoDefer
 * @property string $IsFlyMan
 * @property string $OnlyOwnCity
 * @property string $IsLowestPrice
 * @property string $IsLowestCZSpecialPrice
 * @property string $PunctualityRate
 * @property string $PolicyID
 * @property string $AllowCPType
 * @property string $OutOfPostTime
 * @property string $OutOfSendGetTime
 * @property string $OutOfAirlineCounterTime
 * @property string $CanPost
 * @property string $CanAirlineCounter
 * @property string $CanSendGet
 * @property string $IsRebate
 * @property string $RebateAmount
 * @property string $RebateCPCity
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 */
class CtripFlight extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ctrip_Flight';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DepartCityCode, ArriveCityCode, TakeOffTime, Flight, CraftType, AirlineCode, Price', 'required'),
			array('DepartCityCode, ArriveCityCode, DPortCode, APortCode, DPortBuildingID, APortBuildingID, BeforeFlyDate, Quantity, InventoryType', 'length', 'max'=>3),
			array('TakeOffTime, ArriveTime', 'length', 'max'=>20),
			array('Flight', 'length', 'max'=>6),
			array('CraftType, Rate, RefundFeeFormulaID, CanUpGrade, CanSeparateSale, CanNoDefer, IsFlyMan, OnlyOwnCity, IsLowestPrice, IsLowestCZSpecialPrice, OutOfPostTime, OutOfSendGetTime, OutOfAirlineCounterTime, CanPost, CanAirlineCounter, CanSendGet, IsRebate, RebateAmount, RebateCPCity', 'length', 'max'=>5),
			array('AirlineCode, AdultTax, BabyTax, ChildTax', 'length', 'max'=>2),
			array('Class, SubClass, DisplaySubclass, MealType, StopTimes, Nonrer, Nonend, Nonref, ProductSource, RouteIndex, NeedApplyString, Recommend', 'length', 'max'=>1),
			array('Price, ChildStandardPrice, BabyStandardPrice, ProductType', 'length', 'max'=>8),
			array('StandardPrice, AdultOilFee, BabyOilFee, ChildOilFee, PunctualityRate', 'length', 'max'=>10),
			array('Rernote, Endnote, Refnote, Remarks', 'length', 'max'=>512),
			array('TicketType, AllowCPType', 'length', 'max'=>4),
			array('PriceType, PolicyID', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, DepartCityCode, ArriveCityCode, TakeOffTime, ArriveTime, Flight, CraftType, AirlineCode, Class, SubClass, DisplaySubclass, Rate, Price, StandardPrice, ChildStandardPrice, BabyStandardPrice, MealType, AdultTax, BabyTax, ChildTax, AdultOilFee, BabyOilFee, ChildOilFee, DPortCode, APortCode, DPortBuildingID, APortBuildingID, StopTimes, Nonrer, Nonend, Nonref, Rernote, Endnote, Refnote, Remarks, TicketType, BeforeFlyDate, Quantity, PriceType, ProductType, ProductSource, InventoryType, RouteIndex, NeedApplyString, Recommend, RefundFeeFormulaID, CanUpGrade, CanSeparateSale, CanNoDefer, IsFlyMan, OnlyOwnCity, IsLowestPrice, IsLowestCZSpecialPrice, PunctualityRate, PolicyID, AllowCPType, OutOfPostTime, OutOfSendGetTime, OutOfAirlineCounterTime, CanPost, CanAirlineCounter, CanSendGet, IsRebate, RebateAmount, RebateCPCity', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Order', 'ID_flight'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'DepartCityCode' => 'Depart City Code',
			'ArriveCityCode' => 'Arrive City Code',
			'TakeOffTime' => 'Take Off Time',
			'ArriveTime' => 'Arrive Time',
			'Flight' => 'Flight',
			'CraftType' => 'Craft Type',
			'AirlineCode' => 'Airline Code',
			'Class' => 'Class',
			'SubClass' => 'Sub Class',
			'DisplaySubclass' => 'Display Subclass',
			'Rate' => 'Rate',
			'Price' => 'Price',
			'StandardPrice' => 'Standard Price',
			'ChildStandardPrice' => 'Child Standard Price',
			'BabyStandardPrice' => 'Baby Standard Price',
			'MealType' => 'Meal Type',
			'AdultTax' => 'Adult Tax',
			'BabyTax' => 'Baby Tax',
			'ChildTax' => 'Child Tax',
			'AdultOilFee' => 'Adult Oil Fee',
			'BabyOilFee' => 'Baby Oil Fee',
			'ChildOilFee' => 'Child Oil Fee',
			'DPortCode' => 'Dport Code',
			'APortCode' => 'Aport Code',
			'DPortBuildingID' => 'Dport Building',
			'APortBuildingID' => 'Aport Building',
			'StopTimes' => 'Stop Times',
			'Nonrer' => 'Nonrer',
			'Nonend' => 'Nonend',
			'Nonref' => 'Nonref',
			'Rernote' => 'Rernote',
			'Endnote' => 'Endnote',
			'Refnote' => 'Refnote',
			'Remarks' => 'Remarks',
			'TicketType' => 'Ticket Type',
			'BeforeFlyDate' => 'Before Fly Date',
			'Quantity' => 'Quantity',
			'PriceType' => 'Price Type',
			'ProductType' => 'Product Type',
			'ProductSource' => 'Product Source',
			'InventoryType' => 'Inventory Type',
			'RouteIndex' => 'Route Index',
			'NeedApplyString' => 'Need Apply String',
			'Recommend' => 'Recommend',
			'RefundFeeFormulaID' => 'Refund Fee Formula',
			'CanUpGrade' => 'Can Up Grade',
			'CanSeparateSale' => 'Can Separate Sale',
			'CanNoDefer' => 'Can No Defer',
			'IsFlyMan' => 'Is Fly Man',
			'OnlyOwnCity' => 'Only Own City',
			'IsLowestPrice' => 'Is Lowest Price',
			'IsLowestCZSpecialPrice' => 'Is Lowest Czspecial Price',
			'PunctualityRate' => 'Punctuality Rate',
			'PolicyID' => 'Policy',
			'AllowCPType' => 'Allow Cptype',
			'OutOfPostTime' => 'Out Of Post Time',
			'OutOfSendGetTime' => 'Out Of Send Get Time',
			'OutOfAirlineCounterTime' => 'Out Of Airline Counter Time',
			'CanPost' => 'Can Post',
			'CanAirlineCounter' => 'Can Airline Counter',
			'CanSendGet' => 'Can Send Get',
			'IsRebate' => 'Is Rebate',
			'RebateAmount' => 'Rebate Amount',
			'RebateCPCity' => 'Rebate Cpcity',
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
		$criteria->compare('DepartCityCode',$this->DepartCityCode,true);
		$criteria->compare('ArriveCityCode',$this->ArriveCityCode,true);
		$criteria->compare('TakeOffTime',$this->TakeOffTime,true);
		$criteria->compare('ArriveTime',$this->ArriveTime,true);
		$criteria->compare('Flight',$this->Flight,true);
		$criteria->compare('CraftType',$this->CraftType,true);
		$criteria->compare('AirlineCode',$this->AirlineCode,true);
		$criteria->compare('Class',$this->Class,true);
		$criteria->compare('SubClass',$this->SubClass,true);
		$criteria->compare('DisplaySubclass',$this->DisplaySubclass,true);
		$criteria->compare('Rate',$this->Rate,true);
		$criteria->compare('Price',$this->Price,true);
		$criteria->compare('StandardPrice',$this->StandardPrice,true);
		$criteria->compare('ChildStandardPrice',$this->ChildStandardPrice,true);
		$criteria->compare('BabyStandardPrice',$this->BabyStandardPrice,true);
		$criteria->compare('MealType',$this->MealType,true);
		$criteria->compare('AdultTax',$this->AdultTax,true);
		$criteria->compare('BabyTax',$this->BabyTax,true);
		$criteria->compare('ChildTax',$this->ChildTax,true);
		$criteria->compare('AdultOilFee',$this->AdultOilFee,true);
		$criteria->compare('BabyOilFee',$this->BabyOilFee,true);
		$criteria->compare('ChildOilFee',$this->ChildOilFee,true);
		$criteria->compare('DPortCode',$this->DPortCode,true);
		$criteria->compare('APortCode',$this->APortCode,true);
		$criteria->compare('DPortBuildingID',$this->DPortBuildingID,true);
		$criteria->compare('APortBuildingID',$this->APortBuildingID,true);
		$criteria->compare('StopTimes',$this->StopTimes,true);
		$criteria->compare('Nonrer',$this->Nonrer,true);
		$criteria->compare('Nonend',$this->Nonend,true);
		$criteria->compare('Nonref',$this->Nonref,true);
		$criteria->compare('Rernote',$this->Rernote,true);
		$criteria->compare('Endnote',$this->Endnote,true);
		$criteria->compare('Refnote',$this->Refnote,true);
		$criteria->compare('Remarks',$this->Remarks,true);
		$criteria->compare('TicketType',$this->TicketType,true);
		$criteria->compare('BeforeFlyDate',$this->BeforeFlyDate,true);
		$criteria->compare('Quantity',$this->Quantity,true);
		$criteria->compare('PriceType',$this->PriceType,true);
		$criteria->compare('ProductType',$this->ProductType,true);
		$criteria->compare('ProductSource',$this->ProductSource,true);
		$criteria->compare('InventoryType',$this->InventoryType,true);
		$criteria->compare('RouteIndex',$this->RouteIndex,true);
		$criteria->compare('NeedApplyString',$this->NeedApplyString,true);
		$criteria->compare('Recommend',$this->Recommend,true);
		$criteria->compare('RefundFeeFormulaID',$this->RefundFeeFormulaID,true);
		$criteria->compare('CanUpGrade',$this->CanUpGrade,true);
		$criteria->compare('CanSeparateSale',$this->CanSeparateSale,true);
		$criteria->compare('CanNoDefer',$this->CanNoDefer,true);
		$criteria->compare('IsFlyMan',$this->IsFlyMan,true);
		$criteria->compare('OnlyOwnCity',$this->OnlyOwnCity,true);
		$criteria->compare('IsLowestPrice',$this->IsLowestPrice,true);
		$criteria->compare('IsLowestCZSpecialPrice',$this->IsLowestCZSpecialPrice,true);
		$criteria->compare('PunctualityRate',$this->PunctualityRate,true);
		$criteria->compare('PolicyID',$this->PolicyID,true);
		$criteria->compare('AllowCPType',$this->AllowCPType,true);
		$criteria->compare('OutOfPostTime',$this->OutOfPostTime,true);
		$criteria->compare('OutOfSendGetTime',$this->OutOfSendGetTime,true);
		$criteria->compare('OutOfAirlineCounterTime',$this->OutOfAirlineCounterTime,true);
		$criteria->compare('CanPost',$this->CanPost,true);
		$criteria->compare('CanAirlineCounter',$this->CanAirlineCounter,true);
		$criteria->compare('CanSendGet',$this->CanSendGet,true);
		$criteria->compare('IsRebate',$this->IsRebate,true);
		$criteria->compare('RebateAmount',$this->RebateAmount,true);
		$criteria->compare('RebateCPCity',$this->RebateCPCity,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CtripFlight the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
