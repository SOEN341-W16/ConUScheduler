<?php
/* @var $this CourselistController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Courselists',
);

$this->menu=array(
	array('label'=>'Create Courselist', 'url'=>array('create')),
	array('label'=>'Manage Courselist', 'url'=>array('admin')),
);
?>

<h1>Courselists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
