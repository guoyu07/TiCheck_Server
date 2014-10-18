<?php
/* @var $this SubscriptionController */
/* @var $model Subscription */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subscription-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'DepartCity'); ?>
		<?php echo $form->textField($model,'DepartCity',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'DepartCity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ArriveCity'); ?>
		<?php echo $form->textField($model,'ArriveCity',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'ArriveCity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'StartDate'); ?>
		<?php echo $form->textField($model,'StartDate'); ?>
		<?php echo $form->error($model,'StartDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EndDate'); ?>
		<?php echo $form->textField($model,'EndDate'); ?>
		<?php echo $form->error($model,'EndDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EarliestDepartTime'); ?>
		<?php echo $form->textField($model,'EarliestDepartTime'); ?>
		<?php echo $form->error($model,'EarliestDepartTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LatestDepartTime'); ?>
		<?php echo $form->textField($model,'LatestDepartTime'); ?>
		<?php echo $form->error($model,'LatestDepartTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PriceLimit'); ?>
		<?php echo $form->textField($model,'PriceLimit'); ?>
		<?php echo $form->error($model,'PriceLimit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AirlineDibitCode'); ?>
		<?php echo $form->textField($model,'AirlineDibitCode',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'AirlineDibitCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ArriveAirport'); ?>
		<?php echo $form->textField($model,'ArriveAirport',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'ArriveAirport'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DepartAirport'); ?>
		<?php echo $form->textField($model,'DepartAirport',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'DepartAirport'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->