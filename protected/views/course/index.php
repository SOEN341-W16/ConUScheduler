<?php
/* @var $this CourseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Course Browser',
);


$this->menu=array(
	array('label'=>'Create Course', 'url'=>array('create'),  'visible'=> Yii::app()->user->isAdmin() ),
	array('label'=>'Manage Courses', 'url'=>array('admin'), 'visible'=> Yii::app()->user->isAdmin() ),
);
?>

<h1>Courses Browser</h1>

<?php

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));



?>
