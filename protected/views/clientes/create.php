<?php
$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Clientes','url'=>array('index')),
	array('label'=>'Gestionar Clientes','url'=>array('admin')),
);
$this->pageTitle = "Nuevo cliente";

?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>