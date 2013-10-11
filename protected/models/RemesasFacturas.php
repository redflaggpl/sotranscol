<?php

/**
 * This is the model class for table "remesas_facturas".
 *
 * The followings are the available columns in table 'remesas_facturas':
 * @property integer $id
 * @property string $remesas_id
 * @property string $facturas_id
 *
 * The followings are the available model relations:
 * @property Facturas $facturas
 * @property Remesas $remesas
 */
class RemesasFacturas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RemesasFacturas the static model class
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
		return 'remesas_facturas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('remesas_id, facturas_id', 'required'),
			array('remesas_id, facturas_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, remesas_id, facturas_id', 'safe', 'on'=>'search'),
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
			'facturas' => array(self::BELONGS_TO, 'Facturas', 'facturas_id'),
			'remesas' => array(self::BELONGS_TO, 'Remesas', 'remesas_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'remesas_id' => 'Remesas',
			'facturas_id' => 'Facturas',
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
		$criteria->compare('remesas_id',$this->remesas_id,true);
		$criteria->compare('facturas_id',$this->facturas_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}