<?php
$this->breadcrumbs=array(
	'Facturas'=>array('index'),
	'Gestión',
);

$this->menu=array(
	array('label'=>'Crear','url'=>array('create')),
);
$this->pageTitle = "Gestión de Facturas";

?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'facturas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'id',
			'htmlOptions'=>array('style'=>'width:80px'),
		),
		array(
			'name'=>'clientes_id',
			'value'=>'$data->clientes->nombre',
		),
		'fecha',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
