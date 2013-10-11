<?php
$this->breadcrumbs=array(
	'Facturas',
);

$this->menu=array(
	array('label'=>'Crear Facturas','url'=>array('create')),
	array('label'=>'Gestionar Facturas','url'=>array('admin')),
);
?>

<h1>Facturas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
