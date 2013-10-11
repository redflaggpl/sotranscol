<?php
$this->breadcrumbs=array(
	'Vehículos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Gestionar','url'=>array('admin')),
);

$this->pageTitle = "Nuevo Vehículo";

?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>