<?php

/**
 * This is the model class for table "remesas".
 *
 * The followings are the available columns in table 'remesas':
 * @property string $id
 * @property string $fecha
 * @property string $oficina
 * @property string $cargo_oficina
 * @property string $remitente
 * @property string $destinatario
 * @property string $direccion
 * @property string $telefono
 * @property integer $departamento_id
 * @property integer $ciudad_id
 * @property string $fletes
 * @property string $valor_aforo
 * @property string $v_u
 * @property integer $vehiculos_id
 * @property integer $papelera
 *
 * The followings are the available model relations:
 * @property Vehiculos $vehiculos
 * @property RemesasDetalle[] $remesasDetalles
 * @property RemesasFacturas[] $remesasFacturases
 */
class Remesas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Remesas the static model class
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
		return 'remesas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, oficinas_id, remitente_id, destinatario, direccion, telefono, departamento_id, ciudad_id, vehiculos_id', 'required'),
			array('oficinas_id, remitente_id, departamento_id, ciudad_id, vehiculos_id, papelera', 'numerical', 'integerOnly'=>true),
			array('cargo_oficina, destinatario, telefono', 'length', 'max'=>45),
			array('direccion', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, facturado, oficinas_id, observaciones, remitente_id, fecha, cargo_oficina, destinatario, direccion, telefono, departamento_id, ciudad_id, fletes, valor_aforo, v_u, vehiculos_id, papelera', 'safe', 'on'=>'search'),
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
			'oficina' => array(self::BELONGS_TO, 'Oficinas', 'oficinas_id'),
			'remitente' => array(self::BELONGS_TO, 'Clientes', 'remitente_id'),
			'vehiculos' => array(self::BELONGS_TO, 'Vehiculos', 'vehiculos_id'),
			'departamento' => array(self::BELONGS_TO, 'Departamentos', 'departamento_id'),
			'ciudad' => array(self::BELONGS_TO, 'Municipios', 'ciudad_id'),
			'items' => array(self::HAS_MANY, 'RemesasItems', 'remesas_id'),
			'remesasFacturases' => array(self::HAS_MANY, 'RemesasFacturas', 'remesas_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'Fecha',
			'oficinas_id' => 'Oficina',
			'cargo_oficina' => 'Cargo Oficina',
			'remitente_id' => 'Remitente',
			'destinatario' => 'Destinatario',
			'direccion' => 'Direccion',
			'telefono' => 'Telefono',
			'departamento_id' => 'Departamento',
			'ciudad_id' => 'Ciudad',
			'fletes' => 'Fletes',
			'valor_aforo' => 'Valor Aforo',
			'v_u' => 'V U',
			'vehiculos_id' => 'Vehiculos',
			'papelera' => 'Papelera',
			'observaciones' => 'Observaciones',
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

		$criteria->compare('t.id',$this->id,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('oficina',$this->oficina,true);
		$criteria->compare('cargo_oficina',$this->cargo_oficina,true);
		//$criteria->compare('remitente',$this->remitente,true);
		$criteria->compare('remitente.nombre',$this->remitente_id,true);
		$criteria->compare('destinatario',$this->destinatario,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('departamento_id',$this->departamento_id);
		$criteria->compare('ciudad.nombre',$this->ciudad_id, true);
		$criteria->compare('fletes',$this->fletes,true);
		$criteria->compare('valor_aforo',$this->valor_aforo,true);
		$criteria->compare('v_u',$this->v_u,true);
		$criteria->compare('vehiculos_id',$this->vehiculos_id);
		$criteria->compare('papelera',$this->papelera);
		$criteria->compare('facturado',$this->facturado, true);
		$criteria->compare('observaciones',$this->observaciones, true);
		$criteria->order = "t.id DESC";
		$criteria->with = array('remitente', 'ciudad');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getTotal()
	{
		$data = "";
		foreach($this->items as $i)
			$data += $i->cta_corriente;

		return $data;
	}

	public function getRemesasFacturables($clienteId)
	{
        $criteria = new CDbCriteria;
        $criteria->addCondition("t.remitente_id = {$clienteId}");
        $criteria->addCondition('t.facturado = 0');
        $criteria->addCondition('items.cta_corriente > 0');
        $criteria->with = array('items');

        return CHtml::listData(CActiveRecord::model('Remesas')->findAll($criteria), 'id', 'id');
	}


	public $dias=array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
	public $meses=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

	public function formatOracionFecha()
	{
		return 
		date("j",strtotime($this->fecha))." de ".
		$this->meses[date("n",strtotime($this->fecha))]." de ".
		date("Y",strtotime($this->fecha));
	}

	/**
	* Dibuja pdf compatible con windows
	* 
	*/
	public function drawPdfWindows()
	{
		$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
                            'P', 'cm', 'Letter', true, 'UTF-8');
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("Sotranscol");
		$pdf->SetTitle("Remesa " . $this->id);
		$pdf->SetSubject("Remesa " . $this->id);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->AddPage();
		$pdf->SetFont("pdfahelvetica", "", 9);
		 
		/* oficina */
		$pdf->text(4,2.8,strtoupper($this->oficina->nombre));
		$pdf->text(12,2.8,$this->formatOracionFecha());
		//$pdf->text(19,2.8,$this->cargo_oficina);
		$pdf->text(4, 3.2, strtoupper($this->remitente->nombre));
		$pdf->text(4, 3.6, strtoupper($this->destinatario));
		$pdf->text(18, 3.6, strtoupper($this->telefono));
		$pdf->text(4, 4, strtoupper($this->direccion));
		$pdf->text(18, 4, strtoupper($this->ciudad->nombre));

		$y = 4.9;
		foreach($this->items AS $i)
		{
			$pdf->text(2, $y, strtoupper($i->bultos));
			$pdf->text(5, $y, strtoupper($i->kilos));
			$pdf->text(6.5, $y, strtoupper($i->descripcion));
			if($i->contraentrega != 0)
				$pdf->text(15, $y, "$".number_format($i->contraentrega));
			if($i->cta_corriente != 0)
				$pdf->text(17.5, $y, "$".number_format($i->cta_corriente));
			if($i->cancelado != 0)
				$pdf->text(20, $y, "$".number_format($i->cancelado));
			$y += 0.44;
		}
		$pdf->text(6.5, 9.2, strtoupper($this->observaciones));

		$pdf->text(4, 9.4,$this->fletes);
		$pdf->text(4, 9.9, $this->valor_aforo);
		$pdf->text(4, 10.4, $this->v_u);
		$pdf->text(4, 10.9, strtoupper($this->vehiculos->placa));
		$pdf->text(8.5, 10.9, strtoupper($this->vehiculos->conductor));

		//$pdf->Cell(0,10,"Example 002",1,1,'C');
		$pdf->Output("remesa-{$this->id}.pdf", "I");
	}

	public function drawPdf()
	{
		$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
                            'P', 'cm', 'Letter', true, 'UTF-8');
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("Sotranscol");
		$pdf->SetTitle("Remesa " . $this->id);
		$pdf->SetSubject("Remesa " . $this->id);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->AddPage();
		$pdf->SetFont("times", "", 8);
		 
		/* oficina */
		$pdf->text(4,3.2,strtoupper($this->oficina->nombre));
		$pdf->text(12,3.2,$this->formatOracionFecha());
		$pdf->text(19,3.2,$this->cargo_oficina);
		$pdf->text(4, 3.6, strtoupper($this->remitente->nombre));
		$pdf->text(4, 4.2, strtoupper($this->destinatario));
		$pdf->text(18, 4.2, strtoupper($this->telefono));
		$pdf->text(4, 4.8, strtoupper($this->direccion));
		$pdf->text(18, 4.8, strtoupper($this->ciudad->nombre));

		$y = 5.8;
		foreach($this->items AS $i)
		{
			$pdf->text(2, $y, strtoupper($i->bultos));
			$pdf->text(5, $y, strtoupper($i->kilos));
			$pdf->text(6.5, $y, strtoupper($i->descripcion));
			$pdf->text(15, $y, number_format($i->contraentrega));
			$pdf->text(17.5, $y, number_format($i->cta_corriente));
			$pdf->text(20, $y, number_format($i->cancelado));
			$y += 0.5;
		}
		$pdf->text(6.5, 10.8, strtoupper($this->observaciones));

		$pdf->text(4, 11.4,$this->fletes);
		$pdf->text(4, 11.9, $this->valor_aforo);
		$pdf->text(4, 12.4, $this->v_u);
		$pdf->text(4, 12.9, strtoupper($this->vehiculos->placa));
		$pdf->text(8.5, 12.9, strtoupper($this->vehiculos->conductor));

		//$pdf->Cell(0,10,"Example 002",1,1,'C');
		$pdf->Output("example_002.pdf", "I");
	}
}