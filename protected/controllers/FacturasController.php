<?php

class FacturasController extends Controller
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin', 'create','update', 'setRemesa', 'setItem', 'drawPdf'),
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
		$model = $this->loadModel($id);
		$this->render('view',array(
			'model'=> $model,
			'modelRemesas' => new Remesas,
			'ri' => $model->getItemsRemesas(),
			'modelFacturasItems' => new FacturasItems,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Facturas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Facturas']))
		{
			$model->attributes=$_POST['Facturas'];
			$model->fecha = date('Y-m-d');
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

		if(isset($_POST['Facturas']))
		{
			$model->attributes=$_POST['Facturas'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				
			   	$model = $this->loadModel($id);

				$rf = RemesasFacturas::model()->findAll("facturas_id = $model->id");

				foreach ($rf as $i)
				{
					$i->remesas->facturado = 0;
					if(!$i->remesas->save())
						throw new Exception("Error actualizado remesa", 1);
						
					if(!$i->delete())
						throw new Exception("Error borrando remesa de factura", 1);
				}

				$model->delete();
				
				$transaction->commit();
			}
			catch(Exception $e)
			{
			   echo CJSON::encode($e->getMessage());
			   Yii::app()->end();
			   $transaction->rollback();
			}

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
		$model=new Facturas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Facturas']))
			$model->attributes=$_GET['Facturas'];

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
		$model=Facturas::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='facturas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionSetRemesa($id)
	{
		
		$model=new RemesasFacturas;

		if(isset($_POST['Remesas']))
		{
			$model->unsetAttributes();
			$model->remesas_id=$_POST['Remesas']['id'];
			$model->facturas_id = $id;

			$transaction = Yii::app()->db->beginTransaction();
			try 
			{
				if(!$model->save())
				{
					Yii::app()->user->setFlash($model->getErrors());
				}
				else
				{
					$remesa = Remesas::model()->findByPk($model->remesas_id);
					$remesa->facturado = 1;
					$remesa->cerrado = 1;
					if(!$remesa->save())
						Yii::app()->user->setFlash($model->getErrors());
			    	else
			    		$transaction->commit();
				}
			}
			catch(Exception $e) // an exception is raised if a query fails
			{
			    //echo 'Excepción capturada: ',  $e->getMessage(), "\n";
			    $transaction->rollback();
			}
		}
		$this->redirect(array('view','id'=>$id));
	}

	public function actionSetItem($id)
	{
		$model = new FacturasItems;
		if(isset($_POST['FacturasItems']))
		{
			$model->unsetAttributes();
			$model->attributes = $_POST['FacturasItems'];
			$model->facturas_id = $id;
			if(!$model->save())
			{
				Yii::app()->user->setFlash('error', 'Error al registrar la novedad');
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

}
