<?php
$this->menu=array(
    array('label'=>'Profile', 'url'=>array('index')),
);

Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(
    Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
?>

    <h1>Academic Record</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'courses_completed-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'course.course_code',
        'course.credits',
        'Grade',
        'GPA'
    ),
)); ?>

<?php

$sql="SELECT * FROM completed_courses LEFT JOIN course ON completed_courses.courseID=course.ID";

$test=Yii::app()->db->createCommand($sql);
$data=$test->queryAll();
$creditTotal=0;
$sum=0;

foreach ($data as $value)
{
    if ($value['userID']== Yii::app()->user->userID) {
        $sum+=$value['GPA']*$value['credits'];
        $creditTotal+=$value['credits'];

    }

}
if ($creditTotal > 0)
{
    $finalGPA = $sum / $creditTotal;
}
else
{
    $finalGPA = 0;
}
$finalGPA = number_format($finalGPA, 1);
?>
<div><h1>Total GPA: <?php echo $finalGPA; ?></h1></div>




    <div class="form">
<?php

$form=$this->beginWidget('CActiveForm');

?>
        <hr>
    <h3>Add a course to your record</h3>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <div class="row">
        <?php echo $form->labelEx($model,'courseID'); ?>
        <?php echo $form->textField($model,'courseID'); ?>
        <?php echo $form->error($model,'courseID'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'Grade'); ?>
        <?php echo $form->textField($model,'Grade'); ?>
        <?php echo $form->error($model,'Grade'); ?>

    </div>
    <div class="row buttons">
        <?php echo CHtml::button('Add Course', array('submit' =>  array('profile/AddCompleted'))); ?>
    </div>

<?php $this->endWidget(); ?>
    </div>
<?php

    if(isset($_REQUEST['added']))
    {
        $get=$_REQUEST['added'];
        echo "<div>";
        if($_REQUEST['added']==1)
        {
           echo "Class successfully added!";

        }
        elseif($_REQUEST['added']==-1)
        {
            echo"Invalid course code";
        }
        elseif($_REQUEST['added']==-2)
        {
            echo "Invalid grade";
        }
        echo "</div>";
    }


?>
<script>
$(function(){
   $(':button').button();
});
</script>
