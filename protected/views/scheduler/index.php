<?php
/* @var $this SchedulerController
 * @var $model PreferenceForm
 * @var $yearsToShow
/* @var $model
 */

$this->breadcrumbs=array(
	'Scheduler',
);
$this->menu=array(
    array('label'=>'View Saved Schedules', 'url'=>array('ViewSaved')),
);
?>
<script src=""></script>


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



