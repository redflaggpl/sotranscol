<?php

/**
 * This is the model class for table "vehiculos".
 *
 * The followings are the available columns in table 'vehiculos':
 * @property integer $id
 * @property string $placa
 * @property integer $tipos_id
 * @property integer $activo
 * @property string $papelera
 *
 * The followings are the available model relations:
 * @property Remesas[] $remesases
 * @property VehiculosTipos $tipos
 */
class Vehiculos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Vehiculos the static model class
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
		return 'vehiculos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('placa, tipos_id, conductor', 'required'),
			array('tipos_id, activo, papelera', 'numerical', 'integerOnly'=>true),
			array('placa', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, placa, conductor, tipos_id, activo, papelera', 'safe', 'on'=>'search'),
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
			'remesases' => array(self::HAS_MANY, 'Remesas', 'vehiculos_id'),
			'tipos' => array(self::BELONGS_TO, 'VehiculosTipos', 'tipos_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'placa' => 'Placa',
			'conductor' => 'Conductor',
			'tipos_id' => 'Tipo',
			'activo' => 'Activo',
			'papelera' => 'Papelera',
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
		$criteria->compare('placa',$this->placa,true);
		$criteria->compare('conductor',$this->conductor,true);
		$criteria->compare('tipos_id',$this->tipos_id);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('papelera',$this->papelera,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getMenuVehiculos()
	{
		return CHtml::listData($this->findAll('activo=1 AND papelera=0'),"id", "placa");
	}
}