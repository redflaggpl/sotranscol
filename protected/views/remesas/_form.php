<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'remesas-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="row-fluid">
	<div class="span6">
		<?php echo $form->dropDownListRow($model,'oficinas_id',Oficinas::model()->getMenuOficinas(),array('class'=>'span5','empty'=>'--')); ?>

		<?php echo $form->dropDownListRow($model,'remitente_id',Clientes::model()->getMenuClientes(),array('class'=>'span5','empty'=>'--')); ?>

		<?php echo $form->textFieldRow($model,'destinatario',array('class'=>'span5','maxlength'=>45)); ?>

		<?php echo $form->textFieldRow($model,'direccion',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'telefono',array('class'=>'span5','maxlength'=>45)); ?>
		
		<?php echo $form->labelEx($model,'departamento_id'); ?>
		<?php echo $form->dropDownList($model,'departamento_id',Departamentos::model()->getMenu(),
			array(
				'ajax' => array(
			 			'type' => 'POST',
			 			'url' => CController::createUrl('remesas/getCiudades'), 
						'update' => '#Remesas_ciudad_id'
					),
				'prompt' => '--',
				'class'=>'span5','empty'=>'--'
			)
		 ); ?>
		<?php echo $form->error($model,'departamento_id'); ?>

		<?php echo $form->labelEx($model,'ciudad_id');

		if ($model->isNewRecord==1)
		{
			echo $form->dropDownList($model,'ciudad_id',
			array('0' => '--'), array('class'=>'span5','empty'=>'--'));
			// se muestra solo Seleccione un Organismo
		}
		else 
		{
			echo $form->dropDownList($model,'ciudad_id',
			CHtml::listData(Municipios::model()->findAllBySql(
			"select * from municipios where departamentos_id
			=:keyword order by nombre asc",
			array(':keyword'=>$model->departamento_id)),
			'id','nombre'), array('class'=>'span5','empty'=>'--'));
		}
		?>
	</div>

	<div class="span6">

		<?php echo $form->textFieldRow($model,'fletes',array('class'=>'span5','maxlength'=>45)); ?>

		<?php echo $form->textFieldRow($model,'valor_aforo',array('class'=>'span5','maxlength'=>45)); ?>

		<?php echo $form->textFieldRow($model,'v_u',array('class'=>'span5','maxlength'=>45)); ?>

		<?php echo $form->dropDownListRow($model,'vehiculos_id',Vehiculos::model()->getMenuVehiculos(),array('class'=>'span5','empty'=>'--')); ?>
		
		<?php echo $form->textFieldRow($model,'observaciones',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->dropDownListRow($model,'cerrado',array('0'=>'Abierta', '1'=>'Cerrada'),array('class'=>'span5')); ?>

	</div>
</div>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Grabar',
		)); ?>
	</div>
<?php $this->endWidget(); ?>
