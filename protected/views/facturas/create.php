<?php
$this->breadcrumbs=array(
	'Facturas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Facturas','url'=>array('index')),
	array('label'=>'Gestionar Facturas','url'=>array('admin')),
);

$this->pageTitle = "Nueva Factura";

?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>