<?php
/* @var $this SchedulerController
 * @var $model PreferenceForm
 */


$this->breadcrumbs=array(
	'Scheduler',
);
?>

<div id="user-preferences">
    <h3>Select Preferences</h3>
    <?php
    // pass the model to the _preference.php file so that the data from the model can be accessed
    $this->renderPartial('_preference', array(
        'model' => $model,
    ));
    ?>
</div>


<div id="generate-button">
    <input type="button" value="View Schedule">
</div>


