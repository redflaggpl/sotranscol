<?php
$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Crear','url'=>array('create')),
	array('label'=>'Actualizar','url'=>array('update','id'=>$model->id)),
	array('label'=>'Borrar','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gestionar','url'=>array('admin')),
);
$this->pageTitle = "Cliente " . $model->id ;

?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'direccion',
		'telefono',
		'movil',
		'rut',
		array(
			'name'=>'tipos',
			'value'=>$model->getTipo(),
		),
		'fecha_creacion',
		'fecha_actualizacion',
	),
)); ?>
