<?php
/* @var $this SubscriptionController */
/* @var $model Subscription */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DepartCity'); ?>
		<?php echo $form->textField($model,'DepartCity',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ArriveCity'); ?>
		<?php echo $form->textField($model,'ArriveCity',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'StartDate'); ?>
		<?php echo $form->textField($model,'StartDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EndDate'); ?>
		<?php echo $form->textField($model,'EndDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EarliestDepartTime'); ?>
		<?php echo $form->textField($model,'EarliestDepartTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LatestDepartTime'); ?>
		<?php echo $form->textField($model,'LatestDepartTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PriceLimit'); ?>
		<?php echo $form->textField($model,'PriceLimit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AirlineDibitCode'); ?>
		<?php echo $form->textField($model,'AirlineDibitCode',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ArriveAirport'); ?>
		<?php echo $form->textField($model,'ArriveAirport',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DepartAirport'); ?>
		<?php echo $form->textField($model,'DepartAirport',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->