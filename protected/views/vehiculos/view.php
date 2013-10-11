<?php
$this->breadcrumbs=array(
	'Vehículos'=>array('index'),
	$model->id,
);

$this->menu=array(
	
	array('label'=>'Crear','url'=>array('create')),
	array('label'=>'Actualizar','url'=>array('update','id'=>$model->id)),
	array('label'=>'Borrar','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gestionar','url'=>array('admin')),
);

$this->pageTitle = "Vehículo " . $model->id ;

?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'placa',
		'conductor',
		array(
			'name'=>'tipos_id',
			'value'=>$model->tipos->descripcion,
		),
	),
)); ?>
