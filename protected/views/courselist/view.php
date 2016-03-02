<?php
/* @var $this CourselistController */
/* @var $model Courselist */

$this->breadcrumbs=array(
	'Courselists'=>array('index'),
	$model->ID,
);


$this->menu=array(
	array('label'=>'List Courselist', 'url'=>array('index')),
	array('label'=>'Create Courselist', 'url'=>array('create')),
	array('label'=>'Update Courselist', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Courselist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Courselist', 'url'=>array('admin')),
);
?>

<h1>View Courselist #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'course_code',
		'course_description',
	),
)); ?>
