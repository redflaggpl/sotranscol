<?php
$this->breadcrumbs=array(
	'Facturas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Crear Factura','url'=>array('create')),
	array('label'=>'Ver Factura','url'=>array('view','id'=>$model->id)),
	array('label'=>'Gestionar Facturas','url'=>array('admin')),
);

$this->pageTitle = "Editando Factura " . $model->id ;

?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>