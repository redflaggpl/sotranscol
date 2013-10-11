<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'vehiculos-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'placa',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'conductor',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->dropDownListRow($model,'tipos_id',VehiculosTipos::model()->getMenuVehiculosTipos(),array('class'=>'span5','empty'=>'--')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Grabar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
