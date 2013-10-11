<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'nombre',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'direccion',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'rut',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'tipos',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fecha_creacion',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fecha_actualizacion',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'papelera',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
