<?php
$this->breadcrumbs=array(
	'Vehiculos Tiposes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List VehiculosTipos','url'=>array('index')),
	array('label'=>'Create VehiculosTipos','url'=>array('create')),
	array('label'=>'Update VehiculosTipos','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete VehiculosTipos','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VehiculosTipos','url'=>array('admin')),
);
?>

<h1>View VehiculosTipos #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'descripcion',
	),
)); ?>
