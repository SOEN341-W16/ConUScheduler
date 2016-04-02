<?php
$this->menu=array(
    array('label'=>'Profile', 'url'=>array('index')),
);
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
$finalGPA=$sum/$creditTotal;
$finalGPA=round($finalGPA,2);
echo "<h2>";

echo "Total GPA: $finalGPA";
echo "</h2>";
?>