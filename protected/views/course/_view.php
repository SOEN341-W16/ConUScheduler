<?php
/* @var $this CourseController */
/* @var $data Course */


$prerequisitesQuery = Yii::app()->db->createCommand()
	->select('c.course_description, c.course_code, c.ID')
	->from('course C')
	->join('prerequisite p', 'p.prerequisiteID = c.ID')
	->where('p.courseID=:id', array(':id'=>$data->ID))
	->queryAll();


?>
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::encode($data->ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_code')); ?>:</b>
	<?php echo CHtml::encode($data->course_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_description')); ?>:</b>
	<?php echo CHtml::encode($data->course_description); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('credits')); ?>:</b>
	<?php echo CHtml::encode($data->credits); ?>
	<br />

	<b>Prerequisites:</b>
	<?php
	$prerequisites = array();
		foreach($prerequisitesQuery as $courseData)
		{
			$prerequisites[] = CHtml::link(CHtml::encode($courseData["course_code"]), array('view', 'id'=>$courseData["ID"]));
		}
	echo (empty($prerequisites) ? "-" : implode(", ",$prerequisites));
	?>

	<br />


</div>