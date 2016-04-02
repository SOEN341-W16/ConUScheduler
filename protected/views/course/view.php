<?php
/* @var $this CourseController */
/* @var $model Course */

$this->breadcrumbs=array(
	'Course Browser'=>array('index'),
	$model->ID,
);


$this->menu=array(
	array('label'=>'List Courses', 'url'=>array('index')),
	array('label'=>'Create Course', 'url'=>array('create'), 'visible'=> Yii::app()->user->isAdmin() ),
	array('label'=>'Update Course', 'url'=>array('update', 'id'=>$model->ID), 'visible'=> Yii::app()->user->isAdmin() ),
	array('label'=>'Delete Course', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?'), 'visible'=> Yii::app()->user->isAdmin() ),
	array('label'=>'Manage Course', 'url'=>array('admin'), 'visible'=> Yii::app()->user->isAdmin() ),
);
?>

<h1>View Course #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'course_code',
		'course_description',
	),
)); ?>
