<?php
$this->breadcrumbs=array(
	'Vehiculos Tiposes',
);

$this->menu=array(
	array('label'=>'Create VehiculosTipos','url'=>array('create')),
	array('label'=>'Manage VehiculosTipos','url'=>array('admin')),
);
?>

<h1>Vehiculos Tiposes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
