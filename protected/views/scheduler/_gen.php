<?php
/* @var $schedule */

$sequence[1]["fall"][] = "COMP 248";
$sequence[1]["fall"][] = "COMP 232";
$sequence[1]["fall"][] = "ENGR 201";
$sequence[1]["fall"][] = "ENGR 213";


$sequence[1]["winter"][] = "SOEN 228";
$sequence[1]["winter"][] = "ENGR 233";
$sequence[1]["winter"][] = "SOEN 287";
$sequence[1]["winter"][] = "COMP 249";


$sequence[2]["fall"][] = "COMP 348";
$sequence[2]["fall"][] = "COMP 352";
$sequence[2]["fall"][] = "ENCS 282";
$sequence[2]["fall"][] = "ENGR 202";

$sequence[2]["winter"][] = "COMP 346";
$sequence[2]["winter"][] = "ELEC 275";
$sequence[2]["winter"][] = "ENGR 371";
$sequence[2]["winter"][] = "SOEN 331";
$sequence[2]["winter"][] = "SOEN 341";


$sequence[3]["fall"][] = "COMP 335";
$sequence[3]["fall"][] = "SOEN 342";
$sequence[3]["fall"][] = "SOEN 343";
$sequence[3]["fall"][] = "SOEN 384";
$sequence[3]["fall"][] = "ENGR 391";

$sequence[3]["winter"][] = "SOEN 344";
$sequence[3]["winter"][] = "SOEN 345";
$sequence[3]["winter"][] = "SOEN 357";
$sequence[3]["winter"][] = "SOEN 390";


$sequence[4]["fall"][] = "SOEN 490";
$sequence[4]["fall"][] = "ENGR 301";
$sequence[4]["fall"][] = "SOEN 321";


$sequence[4]["winter"][] = "SOEN 385";
$sequence[4]["winter"][] = "ENGR 392";
$sequence[4]["winter"][] = "SOEN 490";

Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(
    Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');

foreach ($schedule as $id => $scheduleData)
{
    if ($scheduleData["course_type"] == "nat")
    {
        $sequence[1]["winter"][] = $scheduleData["course_code"];
        $sequence[2]["fall"][] = $scheduleData["course_code"];
    }
    if ($scheduleData["course_type"] == "gen")
    {
        $sequence[1]["fall"][] = $scheduleData["course_code"];
    }
}


foreach ($sequence as $year => $sequenceData)
{
    if(!in_array($year, $yearsToShow))
        continue;
    ?>

    <h1>Year <?php echo $year; ?></h1>
    <?php
    foreach ($sequenceData as $semester => $courses)
    {

        ?>

        <h1><?php echo $semester; ?></h1>

            <?php
            foreach ($courses as $i => $course)
            {
                foreach ($schedule as $id => $courseData)
                {
                    $foundCourses = 0;
                    if ($semester == $courseData["semester"] && $course == $courseData["course_code"])
                    {
                        $foundCourses++;

                        ?>

                        <table id="section_table" data-sectionid="<?php echo $id;?>" data-course="<?php echo $courseData["course_code"]; ?>">
                        <thead>
                        <tr>
                            <th>Lecture</th>
                            <th>Course</th>
                            <th>Section</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Days</th>

                        </tr>
                        </thead>
                        <tbody>

                        <tr courserow-id="<?php echo $id;?>">
                            <td><?php echo $id; ?></td>
                            <td><?php echo $courseData["course_code"]; ?></td>
                            <td><?php echo $courseData["section"]; ?></td>
                            <td><?php echo $courseData["start_time"]; ?></td>
                            <td><?php echo $courseData["end_time"]; ?></td>
                            <td><?php echo $courseData["days"]; ?></td>

                        </tr>
                        <tr>
                            <td colspan="6"><h6>Labs/Tutorials</h6></td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <table id="subsection_table" data-sectionid="<?php echo $id;?>" data-course="<?php echo $courseData["course_code"]; ?>">
                                    <thead>
                                    <td>Type</td>
                                    <td>Sub Section</td>
                                    <td>Days</td>
                                    <td>Start Time</td>
                                    <td>End Time</td>
                                    <tbody>
                                    <?php
                                    foreach ($courseData["labs_tut"] as $subsectionID => $labdata)
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $labdata["kind"]; ?></td>
                                            <td><?php echo $labdata["section"]; ?></td>
                                            <td><?php echo $labdata["days"]; ?></td>
                                            <td><?php echo $labdata["start_time"]; ?></td>
                                            <td><?php echo $labdata["end_time"]; ?></td>
                                            <td><input name="subsectionID[]" id="subsectionID[]" type="checkbox" data-year="<?php echo $year;?>" data-semester="<?php echo $semester;?>" data-kind="<?php echo $labdata["kind"]; ?>" data-sectionid="<?php echo $id;?>" data-course="<?php echo $courseData["course_code"]; ?>" value="<?php echo $subsectionID ;?>"></td>
                                        </tr>
                                        <?php
                                    } ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                        </table>
                        <?php
                    }
                }
            } ?>

        <?php
    }

}
?>
<div class="row buttons">
    <?php echo CHtml::button('Validate', array('id' => 'validate')); ?>
</div>
<div id="dialog"></div>
<div id="calendar" style="display: none;"></div>
<script>
    $(function(){
        $(":checkbox").on('click',function(){
            var $checkobx = $(this); // cache the checkbox that has just been checked
            var sectionId = $checkobx.data('sectionid');
            var subsectionId = $checkobx.val();
            var kind = $checkobx.data('kind');
            var course = $checkobx.data('course');
            var checkboxes = 0; // total number of checkboxes (subsections)
            var checked = 0; // how many boxes are checked in the subsection

            $("table#subsection_table :checkbox").each(function(){
                if($(this).data('sectionid') == sectionId)
                {
                    checkboxes++; // calcualte number of checkboxes
                    if($(this).is(':checked'))
                        checked++; // calculate how many checkboxes are checked
                }
                // disable similar kinds since there can only be one lab or one tutorial at a time
                if($(this).data('sectionid') == sectionId && $(this).data('kind') == kind && subsectionId != $(this).val())
                {
                    if($checkobx.is(':checked'))
                        $(this).prop('disabled',true);
                    else
                        $(this).prop('disabled',false);
                }
            });
            // disable all other sections
            $("table#subsection_table").each(function(){
                if($(this).data('sectionid') != sectionId && $(this).data('course') == course)
                {
                    var $table = $(this); // cache table
                    $table.find(':checkbox').each(function(){
                        // if the number of checkboxes that are checked is more than zero, disable, if not re-enable
                        if(checked>0)
                            $(this).prop('disabled',true);
                        else
                            $(this).prop('disabled',false);
                    });
                }
            });
        });

        // collect all the checkboxes
        $('#validate').on('click',function(){
            var data = []; // data container
            // collect all the checked checkboxes and their associated attributes
            $("table#subsection_table input[type='checkbox']:checked").each(function(){
                data.push({
                    subsectionid : $(this).val(),
                    sectionid : $(this).data('sectionid'),
                    year : $(this).data('year')
               })
           });
            // JSON it so that it can be passed via Ajax call to a php page
            var data = JSON.stringify(data);

            console.log(JSON.stringify(data));

            $('#dialog').html(data).dialog({ width: 500, heigh: 500});
        });



    });
</script>