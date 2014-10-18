<?php
/* @var $this TiUserController */
/* @var $data TiUser */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Email), array('view', 'id'=>$data->Email)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::encode($data->ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Account')); ?>:</b>
	<?php echo CHtml::encode($data->Account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Password')); ?>:</b>
	<?php echo CHtml::encode($data->Password); ?>
	<br />


</div>