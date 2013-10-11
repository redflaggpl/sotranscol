<?php

/**
 * This is the model class for table "clientes".
 *
 * The followings are the available columns in table 'clientes':
 * @property string $id
 * @property string $nombre
 * @property string $direccion
 * @property string $telefono
 * @property string $movil
 * @property string $rut
 * @property integer $tipos
 * @property string $fecha_creacion
 * @property string $fecha_actualizacion
 * @property integer $papelera
 *
 * The followings are the available model relations:
 * @property Facturas[] $facturases
 */
class Clientes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Clientes the static model class
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
		return 'clientes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, direccion, rut, tipos, fecha_creacion, fecha_actualizacion', 'required'),
			array('tipos, papelera, telefono, movil', 'numerical', 'integerOnly'=>true),
			array('nombre, direccion, rut', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, direccion, telefono, movil, rut, tipos, fecha_creacion, fecha_actualizacion, papelera', 'safe', 'on'=>'search'),
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
			'facturases' => array(self::HAS_MANY, 'Facturas', 'clientes_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'direccion' => 'Dirección',
			'telefono' => 'Telefono',
			'movil' => 'Movil',
			'rut' => 'Rut o Cédula',
			'tipos' => 'Tipo',
			'fecha_creacion' => 'Fecha de Creación',
			'fecha_actualizacion' => 'Fecha de Actualización',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('rut',$this->rut,true);
		$criteria->compare('tipos',$this->tipos);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_actualizacion',$this->fecha_actualizacion,true);
		$criteria->compare('papelera', '0');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getTipos()
	{
		return array(
			'1'=>'Persona Natural',
			'2'=>'Persona Jurídica'
			);
	}

	public function getTipo()
	{
		switch($this->tipos)
		{
			case 1: return "Persona Natural";
			break;
			case 2: return "Persona Jurídica";
		}
	}

	public function getMenuClientes()
	{
		return CHtml::listData($this->findAll('papelera=0'),"id", "nombre");
	}
}