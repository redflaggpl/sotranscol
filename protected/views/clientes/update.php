<?php
$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Crear Cliente','url'=>array('create')),
	array('label'=>'Ver Cliente','url'=>array('view','id'=>$model->id)),
	array('label'=>'Gestionar','url'=>array('admin')),
);

$this->pageTitle = "Editando Cliente " . $model->id ;

?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>