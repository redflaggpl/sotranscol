<?php
$this->breadcrumbs=array(
	'Remesa'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	//array('label'=>'Listar','url'=>array('index')),
	array('label'=>'Crear Remesa','url'=>array('create')),
);
$this->pageTitle = "Gestion de Remesas";

?>

<div class="row-fluid">
	<div class="span12">
		<a href="<?php echo $this->createUrl("remesas/getReporteSinFacturar"); ?>" target="_blank" class="btn btn-warning pull-right"><i class="icon icon-file"></i> Reporte sin facturar</a>
	</div>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'remesas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fecha',
		array(
			'name'=>'oficinas_id',
			'value'=>'$data->oficina->nombre',
		),
		'cargo_oficina',
		array(
			'name'=>'remitente_id',
			'value'=>'$data->remitente->nombre',
		),
		'destinatario',
		/*
		'direccion',
		'telefono',
		'departamento_id',
		'ciudad_id',
		'fletes',
		'valor_aforo',
		'v_u',
		'vehiculos_id',
		'papelera',
		*/
		array(
			'name'=>'facturado',
			'value'=>'($data->facturado == "0") ? "<span class=\"label label-important\">No</span>" : "<span class=\"label label-success\">Si</label>"',
			'filter'=>array('0'=>'No', '1'=>'Si'),
			'type'=>'raw',
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
