<?php
/* @var $this TiUserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ti Users',
);

$this->menu=array(
	array('label'=>'Create TiUser', 'url'=>array('create')),
	array('label'=>'Manage TiUser', 'url'=>array('admin')),
);
?>

<h1>Ti Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
