<?php
/* @var $this SchedulerController
 * @var $model PreferenceForm
 * @var $yearsToShow
/* @var $model
 */

Yii::app()->clientScript->registerCssFile('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css');
Yii::app()->clientScript->registerCoreScript('jquery.ui');

//Yii::app()->clientScript->registerCoreScript('fullcalendar');
$this->breadcrumbs=array(
	'Scheduler',
);
$this->menu=array(
    array('label'=>'View Saved Schedules', 'url'=>array('create')),
);
?>
<script src=""></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.css">
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.print.css">


<div id="user-preferences">
    <h3>Select Preferences</h3>
    <?php
    // pass the model to the _preference.php file so that the data from the model can be accessed
    $this->renderPartial('_preference', array(
        'model' => $model,

    ));
    echo "<br><hr>";
    if(isset($schedule) && !empty($schedule) && !empty($yearsToShow))
    {

        $this->renderPartial('_gen', array(
            'schedule' => $schedule,
            'yearsToShow' => $yearsToShow

        ));

    }
    else
    {
        echo "no results";
    }
    ?>
</div>



