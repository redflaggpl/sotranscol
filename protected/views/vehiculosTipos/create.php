<?php
$this->breadcrumbs=array(
	'Tipos de Vehículo'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar','url'=>array('index')),
	array('label'=>'Gestionar','url'=>array('admin')),
);
?>

<h1>Create VehiculosTipos</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>