<?php
/* @var $this CourselistController */
/* @var $model Courselist */

$this->breadcrumbs=array(
	'Courselists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Courselist', 'url'=>array('index')),
	array('label'=>'Manage Courselist', 'url'=>array('admin')),
);
?>

<h1>Create Courselist</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>