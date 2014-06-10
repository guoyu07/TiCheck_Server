<?php

/**
 * This is the model class for table "Order".
 *
 * The followings are the available columns in table 'Order':
 * @property string $ID
 * @property string $ID_user
 * @property string $OrderStatus
 * @property string $TempOrder
 * @property string $ID_flight
 * @property string $OrderDetail
 *
 * The followings are the available model relations:
 * @property CtripFlight $iDFlight
 * @property TiUser $iDUser
 */
class Order extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_user, TempOrder', 'required'),
			array('ID_user, ID_flight', 'length', 'max'=>20),
			array('OrderStatus', 'length', 'max'=>1),
			array('TempOrder', 'length', 'max'=>50),
			array('OrderDetail', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, ID_user, OrderStatus, TempOrder, ID_flight, OrderDetail', 'safe', 'on'=>'search'),
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
			'iDFlight' => array(self::BELONGS_TO, 'CtripFlight', 'ID_flight'),
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
			'ID_user' => 'Id User',
			'OrderStatus' => 'Order Status',
			'TempOrder' => 'Temp Order',
			'ID_flight' => 'Id Flight',
			'OrderDetail' => 'Order Detail',
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
		$criteria->compare('ID_user',$this->ID_user,true);
		$criteria->compare('OrderStatus',$this->OrderStatus,true);
		$criteria->compare('TempOrder',$this->TempOrder,true);
		$criteria->compare('ID_flight',$this->ID_flight,true);
		$criteria->compare('OrderDetail',$this->OrderDetail,true);

		$criteria->order = 'ID DESC';


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>100000,
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
