<?php
$this->breadcrumbs=array(
	'Vehiculos',
);

$this->menu=array(
	array('label'=>'Crear Vehiculos','url'=>array('create')),
	array('label'=>'Gestionar Vehiculos','url'=>array('admin')),
);
?>

<h1>Vehículos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
