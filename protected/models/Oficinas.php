<?php

/**
 * This is the model class for table "oficinas".
 *
 * The followings are the available columns in table 'oficinas':
 * @property integer $id
 * @property string $nombre
 * @property integer $ciudad_id
 * @property integer $departamento_id
 *
 * The followings are the available model relations:
 * @property Remesas[] $remesases
 */
class Oficinas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Oficinas the static model class
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
		return 'oficinas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, ciudad_id, departamento_id', 'required'),
			array('ciudad_id, departamento_id', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, ciudad_id, departamento_id', 'safe', 'on'=>'search'),
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
			'remesases' => array(self::HAS_MANY, 'Remesas', 'oficinas_id'),
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
			'ciudad_id' => 'Ciudad',
			'departamento_id' => 'Departamento',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('ciudad_id',$this->ciudad_id);
		$criteria->compare('departamento_id',$this->departamento_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

		public function getMenuOficinas()
	{
		return CHtml::listData($this->findAll(),"id", "nombre");
	}

}