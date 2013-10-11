<?php
$this->breadcrumbs=array(
	'Remesas',
);

$this->menu=array(
	array('label'=>'Crear Remesa','url'=>array('create')),
	array('label'=>'Gestionar Remesas','url'=>array('admin')),
);
?>

<h1>Remesas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
