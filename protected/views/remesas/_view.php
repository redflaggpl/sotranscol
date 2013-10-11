<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oficinas_id')); ?>:</b>
	<?php echo CHtml::encode($data->oficinas_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cargo_oficina')); ?>:</b>
	<?php echo CHtml::encode($data->cargo_oficina); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remitente_id')); ?>:</b>
	<?php echo CHtml::encode($data->remitente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destinatario')); ?>:</b>
	<?php echo CHtml::encode($data->destinatario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono')); ?>:</b>
	<?php echo CHtml::encode($data->telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departamento_id')); ?>:</b>
	<?php echo CHtml::encode($data->departamento_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ciudad_id')); ?>:</b>
	<?php echo CHtml::encode($data->ciudad_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fletes')); ?>:</b>
	<?php echo CHtml::encode($data->fletes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor_aforo')); ?>:</b>
	<?php echo CHtml::encode($data->valor_aforo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('v_u')); ?>:</b>
	<?php echo CHtml::encode($data->v_u); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehiculos_id')); ?>:</b>
	<?php echo CHtml::encode($data->vehiculos_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('papelera')); ?>:</b>
	<?php echo CHtml::encode($data->papelera); ?>
	<br />

	*/ ?>

</div>