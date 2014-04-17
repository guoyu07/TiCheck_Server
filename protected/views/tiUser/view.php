<?php
/* @var $this TiUserController */
/* @var $model TiUser */

$this->breadcrumbs=array(
	'Ti Users'=>array('index'),
	$model->Email,
);

$this->menu=array(
	array('label'=>'List TiUser', 'url'=>array('index')),
	array('label'=>'Create TiUser', 'url'=>array('create')),
	array('label'=>'Update TiUser', 'url'=>array('update', 'id'=>$model->Email)),
	array('label'=>'Delete TiUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Email),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TiUser', 'url'=>array('admin')),
);
?>

<h1>View TiUser #<?php echo $model->Email; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Account',
		'Password',
		'Email',
	),
)); ?>
