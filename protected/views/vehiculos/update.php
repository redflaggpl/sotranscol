<?php
$this->breadcrumbs=array(
	'Vehiculos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	
	array('label'=>'Crear','url'=>array('create')),
	array('label'=>'Ver','url'=>array('view','id'=>$model->id)),
	array('label'=>'Gestionar','url'=>array('admin')),
);

$this->pageTitle = "Editando Vehículo " . $model->id ;

?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>