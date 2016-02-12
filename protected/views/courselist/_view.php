<?php
/* @var $this CourselistController */
/* @var $data Courselist */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_code')); ?>:</b>
	<?php echo CHtml::encode($data->course_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_description')); ?>:</b>
	<?php echo CHtml::encode($data->course_description); ?>
	<br />


</div>