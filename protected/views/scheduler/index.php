<?php
/* @var $this SchedulerController
 * @var $model PreferenceForm
 */

//print_r($sections);


	Yii::app()->clientScript->registerCssFile('assets/63b1294f/jui/css/base/jquery-ui.css');

	Yii::app()->clientScript->registerCoreScript('jquery.ui');
$this->breadcrumbs=array(
	'Scheduler',
);


$this->menu=array(
    array('label'=>'View Saved Schedules', 'url'=>array('create')),
);
?>

<script>
    $(function(){
        //console.log($('#yt0').serializeArray());
    })
</script>
<div id="user-preferences">
    <h3>Select Preferences</h3>
    <?php
    // pass the model to the _preference.php file so that the data from the model can be accessed
    $this->renderPartial('_preference', array(
        'model' => $model,

    ));
    echo "<br><hr>";
    if(isset($schedule) && !empty($schedule))
    {

        $this->renderPartial('_gen', array(
            'schedule' => $schedule,

        ));

    }
    else
    {
        echo "no results";
    }
    ?>
</div>



