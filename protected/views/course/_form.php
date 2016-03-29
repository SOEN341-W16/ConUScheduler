<?php
/* @var $this CourseController */
/* @var $model Course */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'course-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
));

Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(
	Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');

?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'course_code'); ?>
		<?php echo $form->textField($model,'course_code',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'course_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'course_description'); ?>
		<?php echo $form->textField($model,'course_description',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'course_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'credits'); ?>
		<?php echo $form->textField($model,'credits',array('size'=>10,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'credits'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cType'); ?>
		<?php echo $form->dropDownList($model,'cType',array('core'=>'Core','nat'=>'Natural Science', 'gen' => 'General Elective', 'tech' => 'Technical Elective')); ?>
		<?php echo $form->error($model,'cType'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
	$(function(){
		$(':button, :submit').button(); // create UI buttons;
	})
</script>