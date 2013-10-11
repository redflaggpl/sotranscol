<?php
$this->breadcrumbs=array(
	'Remesas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualización',
);

$this->pageTitle = "Actualizando Remesa " . $model->id ;

$this->menu=array(
	array('label'=>'Crear','url'=>array('create')),
	array('label'=>'Visualizar','url'=>array('view','id'=>$model->id)),
	array('label'=>'Gestionar','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>