<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'facturas-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'clientes_id',Clientes::model()->getMenuClientes(),array('class'=>'span5','empty'=>'--')); ?>
	
	<?php echo $form->dropDownListRow($model,'cerrado',array('0'=>'Abierta', '1'=>'Cerrada'),array('class'=>'span5')); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Grabar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
