<?php
/* @var $this SubscriptionController */
/* @var $data Subscription */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DepartCity')); ?>:</b>
	<?php echo CHtml::encode($data->DepartCity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ArriveCity')); ?>:</b>
	<?php echo CHtml::encode($data->ArriveCity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('StartDate')); ?>:</b>
	<?php echo CHtml::encode($data->StartDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EndDate')); ?>:</b>
	<?php echo CHtml::encode($data->EndDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EarliestDepartTime')); ?>:</b>
	<?php echo CHtml::encode($data->EarliestDepartTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LatestDepartTime')); ?>:</b>
	<?php echo CHtml::encode($data->LatestDepartTime); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('PriceLimit')); ?>:</b>
	<?php echo CHtml::encode($data->PriceLimit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AirlineDibitCode')); ?>:</b>
	<?php echo CHtml::encode($data->AirlineDibitCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ArriveAirport')); ?>:</b>
	<?php echo CHtml::encode($data->ArriveAirport); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DepartAirport')); ?>:</b>
	<?php echo CHtml::encode($data->DepartAirport); ?>
	<br />

	*/ ?>

</div>