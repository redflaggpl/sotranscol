<?php
$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Crear Clientes','url'=>array('create')),
);

$this->pageTitle = "Gestión de clientes" ;

?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'clientes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombre',
		'direccion',
		'rut',
		'tipos',
		'fecha_creacion',
		/*
		'fecha_actualizacion',
		'papelera',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
