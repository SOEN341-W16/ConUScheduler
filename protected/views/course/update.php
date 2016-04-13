<?php
/* @var $this CourseController */
/* @var $model Course */

$this->breadcrumbs=array(
	'Course'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Courses', 'url'=>array('index')),
	array('label'=>'Create Course', 'url'=>array('create')),
	array('label'=>'View Course', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Courses', 'url'=>array('admin')),
);
?>

<h1>Update Course <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>