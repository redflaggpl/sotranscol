<?php

/**
 * This is the model class for table "remesas_items".
 *
 * The followings are the available columns in table 'remesas_items':
 * @property string $id
 * @property integer $bultos
 * @property double $kilos
 * @property string $descripcion
 * @property integer $seguro
 * @property string $remesas_id
 *
 * The followings are the available model relations:
 * @property Remesas $remesas
 */
class RemesasItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RemesasItems the static model class
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
		return 'remesas_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bultos, kilos, descripcion, remesas_id', 'required'),
			array('clase', 'safe'),
			array('bultos', 'numerical', 'integerOnly'=>true),
			array('kilos, contraentrega, cta_corriente, cancelado', 'numerical'),
			array('descripcion', 'length', 'max'=>255),
			array('remesas_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, bultos, kilos, clase, descripcion, contraentrega, cta_corriente, cancelado, remesas_id', 'safe', 'on'=>'search'),
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
			'bultos' => 'Bultos',
			'kilos' => 'Kilos',
			'clase' => 'Clase',
			'descripcion' => 'Descripcion',
			'contraentrega' => 'Contra Entrega',
			'cta_corriente' => 'Cuenta Corriente',
			'cancelado' => 'Cancelado',
			'remesas_id' => 'Remesa',
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
		$criteria->compare('bultos',$this->bultos);
		$criteria->compare('kilos',$this->kilos);
		$criteria->compare('clase',$this->clase);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('contraentrega',$this->contraentrega);
		$criteria->compare('cta_corriente',$this->cta_corriente);
		$criteria->compare('cancelado',$this->cancelado,true);
		$criteria->compare('remesas_id',$this->remesas_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}