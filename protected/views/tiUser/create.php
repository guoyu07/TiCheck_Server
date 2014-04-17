<?php
/* @var $this TiUserController */
/* @var $model TiUser */

$this->breadcrumbs=array(
	'Ti Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TiUser', 'url'=>array('index')),
	array('label'=>'Manage TiUser', 'url'=>array('admin')),
);
?>

<h1>Create TiUser</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>