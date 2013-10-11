<?php
$this->breadcrumbs=array(
	'Remesas'=>array('index'),
	$model->id,
);

$this->pageTitle = "Remesa " . $model->id ;

$this->menu=array(
	
	array('label'=>'Crear','url'=>array('create')),
	array('label'=>'Actualizar','url'=>array('update','id'=>$model->id)),
	//array('label'=>'Borrar','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gestionar','url'=>array('admin')),
);
?>

<div class="row-fluid">
	<div class="span12">
		<a href="<?php echo $this->createUrl("remesas/drawPdf&id={$model->id}"); ?>" target="_blank" class="btn btn-success pull-right"><i class="icon icon-print"></i> Impresión (Manual) </a>  
		<a href="<?php echo $this->createUrl("remesas/drawPdfFc&id={$model->id}"); ?>" target="_blank" class="btn btn-success pull-right"><i class="icon icon-print"></i> Impresión (Continua)</a> 
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
	<div class="span3">
		<?php $this->widget('bootstrap.widgets.TbDetailView',array(
			'data'=>$model,
			'attributes'=>array(
				'id',
				'fecha',
				array(
					'name'=>'oficina_id',
					'value'=>$model->oficina->nombre,
				),
				'cargo_oficina',
				array(
					'name'=>'remitente_id',
					'value'=>$model->remitente->nombre,
				),
				'destinatario',
				'direccion',
				'telefono',
				array(
					'name'=>'departamento_id',
					'value'=>$model->departamento->nombre,
				),
				array(
					'name'=>'ciudad_id',
					'value'=>$model->ciudad->nombre,
				),
				array(
					'name'=>'fletes',
					'value'=>$model->fletes,
				),
				array(
					'name'=>'valor_aforo',
					'value'=>$model->valor_aforo,
				),
				array(
					'name'=>'v_u',
					'value'=>$model->v_u,
				),
				array(
					'name'=>'vehiculos_id',
					'value'=>$model->vehiculos->placa,
				),
				array(
					'name'=>'facturado',
					'value'=>($model->facturado == 0) ? "<span class='label label-important'>No</span>" :  "<span class='label label-success'>Si</span>",
					'type'=>'raw',
				),
				array(
					'name'=>'observaciones',
					'value'=>$model->observaciones,
				),
				//'papelera',
			),
		)); ?>
	</div>
	<div class="span9">
		<?php if($model->facturado == 0 || $model->cerrado == 0): ?>
		<div class="well well-small">
			<?php echo $this->renderPartial('_itemsform', array('model'=>new RemesasItems, 'id'=>$model->id)); ?>
		</div>
		<?php endif; ?>
			<?php $this->widget('bootstrap.widgets.TbExtendedGridView',array(
				'id'=>'remesas-grid',
				'dataProvider'=>$modelItems->search(),
				'filter'=>$modelItems,
				'columns'=>array(
					'id',
					/*'bultos',
					'clase',
					'kilos',
					'descripcion',*/
					array(
			           'class' => 'editable.EditableColumn',
			           'name' => 'bultos',
			           'editable' => array(    //editable section
			                  //'apply'      => '$data->user_status != 4', //can't edit deleted users
			           		  'apply'      => 'Yii::app()->user->getState("user") == "admin"', //can't edit deleted users
			                  'url'        => $this->createUrl('remesas/editable'),
			                  'placement'  => 'right',
			              )               
			        ),
			        array(
			           'class' => 'editable.EditableColumn',
			           'name' => 'clase',
						'editable' => array(    //editable section
			                  //'apply'      => '$data->user_status != 4', //can't edit deleted users
			           		  'apply'      => 'Yii::app()->user->getState("user") == "admin"', //can't edit deleted users
			                  'url'        => $this->createUrl('remesas/editable'),
			                  'placement'  => 'right',
			              )               
			        ),
			        array(
			           'class' => 'editable.EditableColumn',
			           'name' => 'kilos',
						'editable' => array(    //editable section
			                  //'apply'      => '$data->user_status != 4', //can't edit deleted users
			           		  'apply'      => 'Yii::app()->user->getState("user") == "admin"', //can't edit deleted users
			                  'url'        => $this->createUrl('remesas/editable'),
			                  'placement'  => 'right',
			              )               
			        ),
			        array(
			           'class' => 'editable.EditableColumn',
			           'name' => 'descripcion',
					   'editable' => array(    //editable section
			                  //'apply'      => '$data->user_status != 4', //can't edit deleted users
			           		  'apply'      => 'Yii::app()->user->getState("user") == "admin"', //can't edit deleted users
			                  'url'        => $this->createUrl('remesas/editable'),
			                  'placement'  => 'right',
			              )               
			        ),
					array(
			           'class' => 'editable.EditableColumn',
			           'name' => 'contraentrega',
						'value'=>'number_format($data->contraentrega, 0, ",", ".")',
			           'headerHtmlOptions' => array('style' => 'width: 90px'),
			           'editable' => array(    //editable section
			                  //'apply'      => '$data->user_status != 4', //can't edit deleted users
			           		  'apply'      => 'Yii::app()->user->getState("user") == "admin"', //can't edit deleted users
			                  'url'        => $this->createUrl('remesas/editable'),
			                  'placement'  => 'right',
			              )               
			        ),
					array(
			           'class' => 'editable.EditableColumn',
			           'name' => 'cta_corriente',
						'value'=>'number_format($data->cta_corriente, 0, ",", ".")',
			           'headerHtmlOptions' => array('style' => 'width: 90px'),
			           'editable' => array(    //editable section
			                  //'apply'      => '$data->user_status != 4', //can't edit deleted users
			                  'apply'      => 'Yii::app()->user->getState("user") == "admin"', //can't edit deleted users
			                  'url'        => $this->createUrl('remesas/editable'),
			                  'placement'  => 'right',
			              )               
			        ),
					array(
			           'class' => 'editable.EditableColumn',
			           'name' => 'cancelado',
						'value'=>'number_format($data->cancelado, 0, ",", ".")',
			           'headerHtmlOptions' => array('style' => 'width: px'),
			           'editable' => array(    //editable section
			                  //'apply'      => '$data->user_status != 4', //can't edit deleted user
			                  'apply'      => 'Yii::app()->user->getState("user") == "admin"', //can't edit deleted users
			                  'url'        => $this->createUrl('remesas/editable'),
			                  'placement'  => 'right',
			              )               
			        ),
					/*array(
			            'name'=>'cta_corriente',
						'value'=>'number_format($data->cta_corriente, 0, ",", ".")',
			            
			        ),
					array(
						'name'=>'cancelado',
						'value'=>'number_format($data->cancelado, 0, ",", ".")',
						'type'=>'raw',
					),*/
				),
				'extendedSummary' => array(
			        'title' => 'Total',
			        'columns' => array(
			            'cta_corriente' => array('label'=>'Total', 'class'=>'TbSumOperation')
			        )
			    ),
			    'extendedSummaryOptions' => array(
			        'class' => 'well pull-right',
			        'style' => 'width:300px'
			    ),
			)); ?>
	
	
	</div>
	</div>
</div>
