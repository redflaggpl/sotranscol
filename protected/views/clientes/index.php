<?php
$this->breadcrumbs=array(
	'Clientes',
);

$this->menu=array(
	array('label'=>'Crear Clientes','url'=>array('create')),
	array('label'=>'Gestionar Clientes','url'=>array('admin')),
);
?>

<h1>Clientes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
