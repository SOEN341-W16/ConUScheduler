<?php

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



foreach($schedule as $id => $scheduleData) {
    if ($scheduleData["course_type"] == "nat") {

        $sequence[1]["winter"][] = $scheduleData["course_code"];
        $sequence[2]["fall"][]  = $scheduleData["course_code"];
    }
}





?>
<?php
foreach($sequence as $year => $sequenceData)
{


?>
    <h1>Year <?php echo $year;?></h1>
<table>
    <thead>
    <th>Lecture ID</th>
    <th>Course</th>
    <th>Course Section</th>
    <th>Days</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>Semester</th>
    </thead>
    
    <tbody>
    <?php
    foreach($schedule as $id => $scheduleData)
    {
        if($scheduleData["course_type"] == "nat" && $year == 1)
        {
            $semester[1]["fall"][] =  $scheduleData["course_code"];
        }

        foreach($sequenceData as $semester => $courses)
        {
            foreach($courses as $i => $course_code)
            {
                if($semester == $scheduleData["semester"] && $course_code == $scheduleData["course_code"])
                {
                    ?>
                    <tr>
                        <th><?php echo $id; ?></th>
                        <th><?php echo $scheduleData["course_code"]; ?></th>
                        <th><?php echo $scheduleData["section"]; ?></th>
                        <th><?php echo $scheduleData["days"]; ?></th>
                        <th><?php echo $scheduleData["start_time"]; ?></th>
                        <th><?php echo $scheduleData["end_time"]; ?></th>
                        <th><?php echo $scheduleData["semester"]; ?></th>

                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <table>
                                <thead>
                                <td>Type</td>
                                <td>Sub Section</td>
                                <td>Days</td>
                                <td>Start Time</td>
                                <td>End Time</td>
                                </thead>
                                <tbody>
                                <?php

                                foreach ($scheduleData["labs_tut"] as $labdata) {
                                    ?>
                                    <tr>
                                        <td><?php echo $labdata["kind"]; ?></td>
                                        <td><?php echo $labdata["section"]; ?></td>
                                        <td><?php echo $labdata["days"]; ?></td>
                                        <td><?php echo $labdata["start_time"]; ?></td>
                                        <td><?php echo $labdata["end_time"]; ?></td>
                                    </tr>
                                    <?php
                                } ?>

                                </tbody>

                            </table>
                        </td>
                    </tr>
                    <?php
                }
            }
        }

    }?>
    </tbody>  

</table>
<?php }?>