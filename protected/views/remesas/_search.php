<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'fecha',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'oficina',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'cargo_oficina',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'remitente',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'destinatario',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'direccion',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'telefono',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'departamento_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ciudad_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fletes',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'valor_aforo',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'v_u',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'vehiculos_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'papelera',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
