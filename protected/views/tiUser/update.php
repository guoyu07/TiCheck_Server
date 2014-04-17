<?php
/* @var $this TiUserController */
/* @var $model TiUser */

$this->breadcrumbs=array(
	'Ti Users'=>array('index'),
	$model->Email=>array('view','id'=>$model->Email),
	'Update',
);

$this->menu=array(
	array('label'=>'List TiUser', 'url'=>array('index')),
	array('label'=>'Create TiUser', 'url'=>array('create')),
	array('label'=>'View TiUser', 'url'=>array('view', 'id'=>$model->Email)),
	array('label'=>'Manage TiUser', 'url'=>array('admin')),
);
?>

<h1>Update TiUser <?php echo $model->Email; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>