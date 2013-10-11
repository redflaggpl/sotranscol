<?php
$this->breadcrumbs=array(
	'Vehículos'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Crear','url'=>array('create')),
);
$this->pageTitle = "Gestión de Vehículos ";

?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'vehiculos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'placa',
		'conductor',
		array(
			'name'=>'tipos_id',
			'value'=>'$data->tipos->descripcion',
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
