<?php
$this->breadcrumbs=array(
	'Remesas'=>array('index'),
	'Crear',
);
$this->pageTitle = "Nueva Remesa " ;

$this->menu=array(
	//array('label'=>'List Remesas','url'=>array('index')),
	array('label'=>'Gestionar','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>