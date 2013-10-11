<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('placa')); ?>:</b>
	<?php echo CHtml::encode($data->placa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipos_id')); ?>:</b>
	<?php echo CHtml::encode($data->tipos_id); ?>
	<br />


</div>