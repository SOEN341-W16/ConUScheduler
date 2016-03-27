<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 3/26/2016
 * Time: 12:40 AM
 *
 * @var $schedule SchedulerController
 */
$this->menu=array(
    array('label'=>'Schedule Planner', 'url'=>array('scheduler/index')),
);
$this->breadcrumbs=array(
    'Scheduler',
    'Saved Schedules',
);
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(
    Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');


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
    foreach($schedule as $saveId => $data)
    {
        $day_format = "<strong>%s</strong> %s - %s";
    ?>
        <tr>
            <td><?php echo $saveId;?></td>
            <td><?php echo $data["date_created"];?></td>
            <td><a id="view" data-sch="<?php echo json_encode($data);?>" data-saveid="<?php echo $saveId;?>">View</a></td>
        </tr>
        <tr>
            <td colspan="3">
                <div style="display: none;" id="save_id<?php echo $saveId;?>">
                <?php
                foreach($data['schedule'] as $year => $yearData)
                {
                    ?>

                    <h2>Year <?php echo $year;?></h2>
                    <?php
                    foreach ($yearData as $semester => $semesterData)
                    {
                        ?>
                        <h3><?php echo $semester;?></h3>
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
                                <tr>

                                    <td>
                                        <?php echo $courseData['course_code']. ' - ' . $courseData['course_description'];?>
                                    </td>
                                    <td>
                                        <?php echo $courseData['section_kind'];?>
                                    </td>
                                    <td>
                                        <?php echo sprintf($day_format, $courseData['lecture_days'], $courseData['lecture_start_time'], $courseData['lecture_end_time']);
                                        ?>
                                    <td>
                                        <?php echo $courseData['section_name'];?>
                                    </td>
                                    <td>
                                        <?php echo $courseData['credits'];?>
                                    </td>
                                </tr>

                                <?php

                                foreach($courseData['labs'] as $labID => $lab)
                                { ?>

                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <?php echo $lab['sub_kind'];?>
                                        </td>
                                        <td>
                                            <?php echo sprintf($day_format, $lab['sub_days'], $lab['sub_start_time'], $lab['sub_end_time']);
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $lab['sub_section_name'];?>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <?php
                            }?>
                            </tbody>
                        </table>
                        <?php
                    }
                }?>
                </div>
            </td>
        </tr>
    <?php
    }?>
    </tbody>
</table>
<div id="calendar"></div>
<script type="text/javascript">
    $(function(){
        $('a#view').on('click',function(){
            var saveid = $(this).data('saveid');
            $('div#save_id' +saveid).dialog({
                title : 'Schedule ID# ' +saveid,
                width: 1000,
                height: 799,
                modal : true,
                buttons: {
                    Okay: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        });
    });
</script>