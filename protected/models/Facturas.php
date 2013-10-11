<?php

/**
 * This is the model class for table "facturas".
 *
 * The followings are the available columns in table 'facturas':
 * @property string $id
 * @property string $clientes_id
 * @property string $fecha
 * @property string $remitente
 * @property string $destinatario
 * @property integer $papelera
 *
 * The followings are the available model relations:
 * @property Clientes $clientes
 * @property FacturasItems[] $facturasItems
 * @property RemesasFacturas[] $remesasFacturases
 */
class Facturas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Facturas the static model class
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
		return 'facturas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('clientes_id, fecha', 'required'),
			array('papelera, cerrado', 'numerical', 'integerOnly'=>true),
			array('clientes_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, clientes_id, fecha, papelera, cerrado', 'safe', 'on'=>'search'),
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
			'clientes' => array(self::BELONGS_TO, 'Clientes', 'clientes_id'),
			'facturasItems' => array(self::HAS_MANY, 'FacturasItems', 'facturas_id'),
			'remesasFacturas' => array(self::HAS_MANY, 'RemesasFacturas', 'facturas_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'clientes_id' => 'Clientes',
			'fecha' => 'Fecha',
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

		$criteria->compare('t.id',$this->id,true);
		$criteria->compare('clientes.nombre',$this->clientes_id,true, 'OR');
		$criteria->compare('clientes.rut',$this->clientes_id,true, 'OR');
		$criteria->compare('t.fecha',$this->fecha,true);
		$criteria->compare('t.papelera',$this->papelera);
		$criteria->order = "t.id DESC";
		$criteria->with = array('clientes');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getItemsRemesas()
	{
		$data = array();
		$i = 0;
		foreach($this->remesasFacturas as $r)
		{
			$items = RemesasItems::model()->findAll("remesas_id = $r->remesas_id AND cta_corriente > 0");
			foreach($items as $ri)
			{
				$data[$i]['cumplido'] = $ri->remesas_id;
				$data[$i]['bultos'] = $ri->bultos;
				$data[$i]['kilos'] = $ri->kilos;
				$data[$i]['descripcion'] = $ri->descripcion;
				$data[$i]['destinatario'] = $ri->remesas->destinatario;
				$data[$i]['ciudad'] = $ri->remesas->ciudad->nombre;
				$data[$i]['valor'] = $ri->cta_corriente;
				$i++;
			}
		}
		return $data;
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
		$pdf->text(4,4.7,strtoupper($this->clientes->nombre . "   - (NIT) ". $this->clientes->rut));
		//$pdf->text(20,4.7,"Bogotá");
		$pdf->text(4,5.2,strtoupper($this->clientes->direccion));
		//$pdf->text(4, 6.7, strtoupper($this->clientes->rut));
		$pdf->text(19,6.5,$this->formatOracionFecha($this->fecha));

		$y = 8;
		$suma = 0;
		foreach($this->getItemsRemesas() AS $i)
		{
			$pdf->text(2, $y, strtoupper($i['cumplido']));
			$pdf->text(4, $y, strtoupper($i['bultos']));
			$pdf->text(4.8, $y, strtoupper($i['kilos']));
			$pdf->text(7, $y, strtoupper($i['destinatario']));
			$pdf->SetFont("pdfahelvetica", "", 6);
			$pdf->text(14.5, $y, strtoupper($i['ciudad']));
			$pdf->SetFont("pdfahelvetica", "", 9);
			$pdf->text(19, $y, "$".$this->completarCifra(number_format($i['valor'], 0)));
			$y += 0.5;
			$suma += $i['valor'];
		}

		foreach($this->facturasItems AS $i)
		{
			$pdf->text(7, $y, strtoupper($i->descripcion));
			$pdf->text(19, $y, "$".$this->completarCifra(number_format($i->valor)));
			$y += 0.5;
			$suma += $i->valor;
		}

		$pdf->SetFont("pdfahelvetica", "", 7);
		$pdf->text(4, 20.5, strtoupper($this->traducir($suma) . " PESOS M/CTE"));
		$pdf->SetFont("pdfahelvetica", "", 9);
		$pdf->text(19, 20.5, '$' . number_format($suma));
		//$pdf->Cell(0,10,"Example 002",1,1,'C');
		$pdf->Output("Factura-{$this->id}.pdf", "I");
	}

	public function traducir($num) 
	{ 
	    $partes=explode('.',$num); 
	    $s=$partes[0]; 
	    if (strlen($s)>12) 
	      die('Hasta 12 dígitos'); 
	    $entera=$this->traduccionParcial($s); 
	    if (count($partes)>1) 
	    { 
	      $entera=$entera.' con '.$partes[1]; 
	    } 
	    return ucfirst($entera); 
	}      

  private function traduccionParcial($s) 
  { 
    settype($s,'string');     
    $faltan=strlen($s) % 3; 
    $cad=''; 
    if ($faltan!=0) 
      $faltan=3-$faltan; 
    for($f=1;$f<=$faltan;$f++) 
    { 
      $cad.='0'; 
    } 
    $s=$cad.$s; 
    if (strlen($s)<=3 && $s[0]==0 && $s[1]==0 && $s[2]==0) 
      $resu='cero'; 
    else 
    {   
      $cad1=substr($s,strlen($s)-3,3); 
      $resu=$this->convertir($cad1); 
    } 
    if (strlen($s)>3) 
    { 
      $resu2=''; 
      $cad2=substr($s,strlen($s)-6,3); 
      if ($cad2[0]==0 && $cad2[1]==0 && $cad2[2] ==1) 
    $resu2='mil '; 
      else      
        if ($cad2[0]!=0 || $cad2[1]!=0 || $cad2[2] !=0) 
          $resu2=$this->convertir($cad2,2).'mil '; 
      $resu=$resu2.$resu;             
    } 
    if (strlen($s)>6) 
    { 
      $resu2=''; 
      $cad3=substr($s,strlen($s)-9,3); 
      if ($cad3[0]=='0' && $cad3[1]=='0' && $cad3[2]==1) 
    $resu2='un millón '; 
      else     
      if ($cad3[0]!=0 || $cad3[1]!=0 || $cad3[2] !=0) 
          $resu2=$this->convertir($cad3,2).'millones '; 
      $resu=$resu2.$resu;        
    } 

    if (strlen($s)>9) 
    { 
      $resu2=''; 
      $cad4=substr($s,strlen($s)-12,3); 

      if ($cad4[0]=='0' && $cad4[1]=='0' && $cad4[2]==1) 
      { 
    if ($cad3[0]==0 && $cad3[1]==0 && $cad3[2]==0) 
      $resu2='mil millones '; 
    else 
      $resu2='mil '; 
      }     
      else     
    $resu2=$this->convertir($cad4,2).'mil millones ';         
      $resu=$resu2.$resu;        
    } 
    return trim($resu); 
  } 

  private function convertir($num,$ind=1) 
  { 
    $cad=''; 
    if ($num[0]==1 && $num[1]==0 && $num[2]==0) 
    { 
       return 'cien '; 
    } 
    switch ($num[0]){ 
             case 1:$cad.='ciento ';break; 
         case 2:$cad.='doscientos ';break; 
         case 3:$cad.='trescientos ';break; 
         case 4:$cad.='cuatrocientos ';break; 
         case 5:$cad.='quinientos ';break; 
         case 6:$cad.='seiscientos ';break; 
         case 7:$cad.='setecientos ';break; 
         case 8:$cad.='ochocientos ';break; 
         case 9:$cad.='novecientos ';break;     
    }   
    switch ($num[1]) { 
        case 3:$cad.='treinta ';break; 
        case 4:$cad.='cuarenta ';break; 
        case 5:$cad.='cincuenta ';break; 
        case 6:$cad.='sesenta ';break; 
        case 7:$cad.='setenta ';break; 
        case 8:$cad.='ochenta ';break; 
        case 9:$cad.='noventa ';break;         
    } 
    if ($num[2]>=0 && $num[1]==1) 
    { 
      switch ($num[1].$num[2]) { 
            case 10:$cad.='diez ';break; 
            case 11:$cad.='once ';break; 
        case 12:$cad.='doce ';break; 
        case 13:$cad.='trece ';break; 
        case 14:$cad.='catorce ';break; 
        case 15:$cad.='quince ';break; 
        case 16:$cad.='dieciseis ';break; 
        case 17:$cad.='diecisiete ';break; 
        case 18:$cad.='dieciocho ';break; 
        case 19:$cad.='diecinueve ';break; 
      } 
      return $cad; 
    } 
    if ($num[2]>=0 && $num[1]==2) 
    { 
      switch ($num[1].$num[2]) { 
        case 20:$cad.='veinte ';break;   
        case 21:if ($ind==1) $cad.='veintiuno '; else $cad.='veintiun ';break; 
        case 22:$cad.='veintidos ';break; 
        case 23:$cad.='veintitrés ';break; 
        case 24:$cad.='veinticuatro ';break; 
        case 25:$cad.='veinticinco ';break; 
        case 26:$cad.='veintiseis ';break; 
        case 27:$cad.='veintisiete ';break; 
        case 28:$cad.='veintiocho ';break; 
        case 29:$cad.='veintinueve ';break; 

      } 
      return $cad; 
    } 
    if ($num[2]!=0 && $num[1]!=0) 
    { 
      if ($num[0]>0 || $num[1]>0) 
    $cad.='y '; 
    } 
    if ($num[1]!=1) 
    { 
      switch ($num[2]) { 
            case 1:if ($ind==1) $cad.='uno ';else $cad.='un ';break; 
        case 2:$cad.='dos ';break; 
        case 3:$cad.='tres ';break; 
        case 4:$cad.='cuatro ';break; 
        case 5:$cad.='cinco ';break; 
        case 6:$cad.='seis ';break; 
        case 7:$cad.='siete ';break; 
        case 8:$cad.='ocho ';break; 
        case 9:$cad.='nueve ';break;         
      } 
    }       
    return $cad;   
  } 

  	public $dias=array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
	public $meses=array("","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");

	public function formatOracionFecha()
	{
		return 
		$this->meses[date("n",strtotime($this->fecha))]. " ".
		date("j",strtotime($this->fecha))." de ".
		date("Y",strtotime($this->fecha));
	}

	public function completarCifra($valor)
	{
		$data = "";
		$d = 10-strlen($valor);
		for($i = 0; $i<=$d; $i++)
			$data .= " ";

		return $data.$valor;
	}

}