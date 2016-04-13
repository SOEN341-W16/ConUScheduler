<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 3/26/2016
 * Time: 12:40 AM
 *
 * @var $schedule SchedulerController
 */
$this->menu = array(
    array('label' => 'Schedule Planner', 'url' => array('scheduler/index')),
);
$this->breadcrumbs = array(
    'Scheduler',
    'Saved Schedules',
);
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(
    Yii::app()->clientScript->getCoreScriptUrl() . '/jui/css/base/jquery-ui.css');

?>
Below is a list of your saved schedules
<table>
    <thead>
    <th>ID</th>
    <th>Date Created</th>
    <th>Action</th>
    </thead>
    <tbody>
    <?php
    foreach ($schedule as $saveId => $data)
    {

        $day_format = "<strong>%s</strong> %s - %s";
        ?>
        <tr>
            <td><?php echo $saveId; ?></td>
            <td><?php echo $data["date_created"]; ?></td>
            <td><a data-saveid="<?php echo $saveId; ?>" href="javascript:void(0);" id="view">View</a> | <a
                    data-saveid="<?php echo $saveId; ?>" href="javascript:void(0);" id="delete">Delete</a></td>
        </tr>
        <tr>
            <td colspan="3">
                <div style="display: none;" id="save_id<?php echo $saveId; ?>">
                    <?php
                    foreach ($data['schedule'] as $year => $yearData)
                    {
                        ?>

                        <h2>Year <?php echo $year; ?></h2>
                        <?php
                        foreach ($yearData as $semester => $semesterData)
                        {
                            ?>
                            <h3><?php echo $semester; ?></h3>
                            <table>
                                <thead>

                                <th>Class</th>
                                <th>Kind</th>
                                <th>Days/Times</th>
                                <th>Section</th>
                                <th>Credits</th>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($semesterData as $courseID => $courseData)
                                {
                                    ?>
                                    <tr id="course_<?php echo $courseData['lecture_id']; ?>">

                                        <td>
                                            <?php echo $courseData['course_code'] . ' - ' . $courseData['course_description']; ?>
                                        </td>
                                        <td>
                                            <?php echo $courseData['section_kind']; ?>
                                        </td>
                                        <td>
                                            <?php echo sprintf($day_format, $courseData['lecture_days'], $courseData['lecture_start_time'], $courseData['lecture_end_time']);
                                            ?>
                                        <td>
                                            <?php echo $courseData['section_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $courseData['credits']; ?>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" id="dropCourse"
                                               data-sectionid="<?php echo $courseData['lecture_id']; ?>"
                                               data-scheduleid="<?php echo $saveId; ?>">Drop</a>
                                        </td>
                                    </tr>

                                    <?php

                                    foreach ($courseData['labs'] as $labID => $lab)
                                    { ?>

                                        <tr id="course_<?php echo $courseData['lecture_id']; ?>">
                                            <td>
                                            </td>
                                            <td>
                                                <?php echo $lab['sub_kind']; ?>
                                            </td>
                                            <td>
                                                <?php echo sprintf($day_format, $lab['sub_days'], $lab['sub_start_time'], $lab['sub_end_time']);
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $lab['sub_section_name']; ?>
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                } ?>
                                </tbody>
                            </table>
                            <?php
                        }
                    } ?>
                </div>
            </td>
        </tr>
        <?php
    } ?>
    </tbody>
</table>
<div id="delete-dialog" title="Delete Schedule" style="display: none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
    <div id="delete-dialog-notice"></div>
    </p>
</div>

<div id="drop-dialog" title="Drop Course" style="display: none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
    <div id="drop-dialog-notice"></div>
    </p>
</div>
<script>
    $(function ()
    {
        $('a#view').on('click', function ()
        {

            var saveid = $(this).data('saveid');
            $('div#save_id' + saveid).dialog({
                title: 'Schedule ID# ' + saveid,
                width: 1000,
                height: 799,
                modal: true,
                buttons: {
                    Okay: function ()
                    {
                        $(this).dialog("close");
                    }
                }
            });
        });

        $('a#delete').on('click', function ()
        {

            var saveid = $(this).data('saveid');
            $row = $(this).closest('tr'); // cache the row so we can remove it
            $('#delete-dialog-notice').html('Are you sure you want to delete this schedule?');
            $('#delete-dialog').dialog({
                resizable: false,
                height: 120,
                width: 400,
                modal: true,
                buttons: {
                    "Delete": function ()
                    {
                        $('#delete-dialog-notice').html('Deleting...please wait.')
                        $.ajax({
                            url: "<?php echo Yii::app()->createAbsoluteUrl("scheduler/DeleteSchedule"); ?>",
                            type: "POST",
                            cache: false,
                            data: 'saveid=' + saveid,
                            success: function (data)
                            {
                                if (data)
                                {
                                    $('#delete-dialog').dialog('close');
                                    $row.remove();
                                }
                                else
                                {
                                    $('#delete-dialog-notice').html(data);
                                }

                            },
                            error: function ()
                            {
                                $("#delete-dialog-notice").html("There was an error saving your schedule...");
                            }
                        });

                    },
                    Cancel: function ()
                    {
                        $(this).dialog("close");
                    }
                },
                close: function ()
                {
                    $('#delete-dialog-notice').html("");
                }
            });
        });

        // DROP COURSE
        $('a#dropCourse').on('click', function ()
        {
            var sectionID = $(this).data('sectionid');
            var scheduleID = $(this).data('scheduleid');
            var $courseTable = $('tr#course_' + sectionID);

            $('#drop-dialog-notice').html('Are you sure you want to drop this course?');

            $('#drop-dialog').dialog({
                resizable: false,
                height: 200,
                width: 400,
                modal: true,
                buttons: {
                    "Delete": function ()
                    {
                        $('#drop-dialog-notice').html('Deleting...');
                        $.ajax({
                            url: "<?php echo Yii::app()->createAbsoluteUrl("scheduler/DropCourse"); ?>",
                            type: "POST",
                            cache: false,
                            data: 'sectionID=' + sectionID + '&scheduleID=' + scheduleID,
                            success: function (data)
                            {
                                if (data)
                                {
                                    $('#drop-dialog').dialog('close');
                                    $courseTable.remove();
                                }
                                else
                                {
                                    $('#drop-dialog-notice').html(data);
                                }

                            },
                            error: function ()
                            {
                                $("#delete-dialog-notice").html("There was an error saving your schedule...");
                            }
                        });
                    },
                    Cancel: function ()
                    {
                        $(this).dialog("close");
                    },
                },
                close: function ()
                {
                    $('#drop-dialog-notice').html("");
                }

            });

        });
    });
</script>