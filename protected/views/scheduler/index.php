<?php
/* @var $this SchedulerController
 * @var $model PreferenceForm
 */


$this->breadcrumbs=array(
	'Scheduler',
);


$this->menu=array(
    array('label'=>'View Saved Schedules', 'url'=>array('create')),
);
?>

<script>
    $(function(){
        console.log($('#yt0').serializeArray());
    })
</script>
<div id="user-preferences">
    <h3>Select Preferences</h3>
    <?php
    // pass the model to the _preference.php file so that the data from the model can be accessed
    $this->renderPartial('_preference', array(
        'model' => $model,

    ));
    ?>
</div>




