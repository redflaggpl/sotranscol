<?php
$this->breadcrumbs=array(
	'Vehiculos Tiposes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List VehiculosTipos','url'=>array('index')),
	array('label'=>'Create VehiculosTipos','url'=>array('create')),
	array('label'=>'View VehiculosTipos','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage VehiculosTipos','url'=>array('admin')),
);
?>

<h1>Update VehiculosTipos <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>