<?php

$this->breadcrumbs=array(
	'Facturas'=>array('index'),
	$model->id,
);


$this->menu=array(
	//array('label'=>'List Facturas','url'=>array('index')),
	array('label'=>'Crear','url'=>array('create')),
	array('label'=>'Actualizar','url'=>array('update','id'=>$model->id)),
	//array('label'=>'Borrar','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gestionar','url'=>array('admin')),
);

$this->pageTitle = "Factura " . $model->id ;

?>

<div class="row-fluid">
	<div class="span12">
		<a href="<?php echo $this->createUrl("facturas/drawPdf&id={$model->id}"); ?>" target="_blank" class="btn btn-success pull-right"><i class="icon icon-print"></i> Vista de Impresión</a>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<?php $this->widget('bootstrap.widgets.TbDetailView',array(
			'data'=>$model,
			'attributes'=>array(
				'id',
				array(
					'name'=>'clientes_id',
					'value'=>$model->clientes->nombre,
				),
				array(
					'name'=>'direccion',
					'value'=>$model->clientes->direccion,
				),
				array(
					'name'=>'rut / nit',
					'value'=>$model->clientes->rut,
				),
				'fecha',
			),
		)); ?>
	</div>
	<div class="span6">
		<?php if($model->cerrado == 0): ?>
		<div class="well well-small">
			<h4>Agregar Remesas</h4>
			<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
				'id'=>'remesas-form',
				'enableAjaxValidation'=>false,
				'action'=>'/index.php?r=facturas/setRemesa&id='.$model->id,
			)); ?>
			<?php echo $form->errorSummary($modelRemesas); ?>
			<div class="row-fluid">
				<div class="span12 form-search">
					<?php echo $form->dropDownListRow($modelRemesas,'id',$modelRemesas->getRemesasFacturables($model->clientes_id), array('class'=>'span5','empty'=>'--')); ?>
					<?php $this->widget('bootstrap.widgets.TbButton', array(
						'buttonType'=>'submit',
						'type'=>'primary',
						'label'=>'Agregar Remesa',
					)); ?>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
		<div class="well well-small">
			<h4>Agregar Novedades</h4>
			<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
				'id'=>'remesas-form',
				'enableAjaxValidation'=>false,
				'action'=>'/index.php?r=facturas/setItem&id='.$model->id,
			)); ?>
			<?php echo $form->errorSummary($modelFacturasItems); ?>
			<div class="row-fluid">
				<div class="span12 form-search">
					<?php echo $form->textField($modelFacturasItems,'descripcion', array('class'=>'span6','maxlength'=>255, 'placeholder'=>'Descripción')); ?>
					<?php echo $form->textField($modelFacturasItems,'valor', array('class'=>'span2','maxlength'=>6, 'placeholder'=>'Valor')); ?>

					<?php $this->widget('bootstrap.widgets.TbButton', array(
						'buttonType'=>'submit',
						'type'=>'primary',
						'label'=>'Agregar Novedad',
					)); ?>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
		<?php else: ?>
		<div class="well">
			<h4>Esta factura esta cerrada, no es posible agregar más items</h4>
		</div>
	<?php endif; ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<h2>Remesas</h2>
		<table class="table">
			<tr>
				<th>Cumplido</th>
				<th>Bultos</th>
				<th>Kilos</th>
				<th>Descripción</th>
				<th>Ciudad</th>
				<th>Valor Total</th>
			<tr>
			<?php foreach($ri as $i): ?>
			<tr>
				<td><?php echo $i['cumplido']; ?></td>
				<td><?php echo $i['bultos'];?></td>
				<td><?php echo $i['kilos'];?></td>
				<td><?php echo $i['destinatario'];?></td>
				<td><?php echo $i['ciudad'];?></td>
				<td><?php echo number_format($i['valor'], 0);?></td>
			<tr>
			<?php endforeach; ?>
		</table>
		<h2>Novedades</h2>
		<table class="table">
			<tr>
				<th>Descripción</th>
				<th>Valor</th>
			<tr>
			<?php foreach($model->facturasItems as $i): ?>
			<tr>
				<td><?php echo $i->descripcion; ?></td>
				<td><?php echo number_format($i->valor);?></td>
			<tr>
			<?php endforeach; ?>
		</table>

	</div>
</div>