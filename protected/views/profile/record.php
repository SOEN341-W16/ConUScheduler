<?php
$this->menu=array(
    array('label'=>'Profile', 'url'=>array('index')),
    array('label'=>'Contact Information', 'url'=>array('admin')),
);
?>

<h1>Academic Record</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'courses_completed-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'ID',
        'course.course_code'
    ),
)); ?>
