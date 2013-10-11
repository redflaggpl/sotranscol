<?php

class RemesasController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public $header;

	public $defaultAction = 'admin';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin', 'create','update', 'setItem', 'drawPdf', 'drawPdfFc', 'getCiudades', 'getReporteSinFacturar', 'editable'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$modelItems = new RemesasItems;
		$modelItems->unsetAttributes();
		$modelItems->remesas_id = $id;
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'modelItems'=>$modelItems,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Remesas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Remesas']))
		{
			$model->attributes=$_POST['Remesas'];
			$model->fecha = date('Y-m-d H:i:s');
			$model->papelera = 0;
			$model->observaciones = $_POST['Remesas']['observaciones'];
			$model->v_u = $_POST['Remesas']['v_u'];
			$model->valor_aforo = $_POST['Remesas']['valor_aforo'];
			$model->cargo_oficina = "VALLADOLID";
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Remesas']))
		{
			$model->attributes=$_POST['Remesas'];
			$model->observaciones = $_POST['Remesas']['observaciones'];
			$model->v_u = $_POST['Remesas']['v_u'];
			$model->valor_aforo = $_POST['Remesas']['valor_aforo'];
			if($model->save())
			{
				$this->redirect(array('view','id'=>$model->id));
			}
			else
			{
				echo CJSON::encode($model->getErrors());
				Yii::app()->end();
			}

		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->actionAdmin();
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Remesas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Remesas']))
			$model->attributes=$_GET['Remesas'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Remesas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='remesas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionSetItem($id)
	{
		$model=new RemesasItems;

		$modelRemesa = Remesas::model()->findByPk($id);
		if($modelRemesa->facturado == 1)
		{	
			Yii::app()->user->setFlash('error', 'No se pueden agregar items a remesas facturadas');
			$this->redirect(array('view','id'=>$id));
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RemesasItems']))
		{
			$model->attributes=$_POST['RemesasItems'];
			$model->remesas_id = $_GET['id'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->remesas_id));
			else
			{
				echo CJSON::encode($model->getErrors());
				Yii::app()->end();	
			}
		}
		$this->redirect(array('view','id'=>$id));
	}

	public function actionDrawPdf($id)
	{
		$model = $this->loadModel($id);
		$model->drawPdfWindows();
		$model->cerrado = 1;
		$model->save();			
	}

	public function actionDrawPdfFc($id)
	{
		$model = $this->loadModel($id);
		$model->drawPdfWindowsFc();
		$model->cerrado = 1;
		$model->save();			
	}

	public function actionGetCiudades()
	{
		$data=Municipios::model()->findAllBySql(
			"select * from municipios where departamentos_id
			=:keyword order by nombre asc",
		// Aquí buscamos los diferentes organismos que pertenecen al tipo elegido
		array(':keyword'=>$_POST['Remesas']['departamento_id']));
		$data=CHtml::listData($data,'id','nombre');

		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
		}
		// $id  = $_POST['Remesas']['departamento_id'];
		// $criteria = new CDbCriteria;
		// $criteria->condition = "departamentos_id = $id";
		// return CHtml::listData(Municipios::model()->findAll($criteria),"id", "nombre");

	}

	public function actionGetReporteSinFacturar()
	{
		
		$model= Remesas::model()->findAll('facturado = 0');

		$data = array(
			1=>array('ID', 'Fecha', 'Remitente','Destinatario', 'Valor')
		);

		foreach($model as $i)
			$data[]=array($i->id, $i->fecha, $i->remitente->nombre, $i->destinatario, $i->getTotal());

		// echo CJSON::encode($model);
		// Yii::app()->end();

		// $data = array(
		//     1 => array ('Name', 'Surname'),
		//     array('Schwarz', 'Oliver'),
		//     array('Test', 'Peter')
		// );
		Yii::import('application.extensions.phpexcel.JPhpExcel');
		$xls = new JPhpExcel('UTF-8', false, 'My Test Sheet');
		$xls->addArray($data);
		$xls->generateXML('RemesasNoFacturadas-'.date('Y-m-d'));
	}

	/**
	*	actionEditable
	*	more info http://ybe.demopage.ru/#EditableField
	*/
	public function actionEditable()
	{
	    $es = new EditableSaver('RemesasItems');  // 'GMainCustomerVoucher' is classname of model to be updated
	    $es->update();
	}
}
