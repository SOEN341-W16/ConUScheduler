<?php
/* @var $this CourselistController */
/* @var $model Courselist */

$this->breadcrumbs=array(
	'Courselists'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Courselist', 'url'=>array('index')),
	array('label'=>'Create Courselist', 'url'=>array('create')),
	array('label'=>'View Courselist', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Courselist', 'url'=>array('admin')),
);
?>

<h1>Update Courselist <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>