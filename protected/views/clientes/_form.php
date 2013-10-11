<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'clientes-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'nombre',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'direccion',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'telefono',array('class'=>'span5','maxlength'=>45)); ?>
	
	<?php echo $form->textFieldRow($model,'movil',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'rut',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->dropDownListRow($model,'tipos',$model->getTipos(),array('class'=>'span5','empty'=>'--')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Grabar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
