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


foreach ($schedule as $id => $scheduleData) {
    if ($scheduleData["course_type"] == "nat") {

        $sequence[1]["winter"][] = $scheduleData["course_code"];
        $sequence[2]["fall"][] = $scheduleData["course_code"];
    }
}


foreach ($sequence as $year => $sequenceData)
{
    ?>

    <h1>Year <?php echo $year; ?></h1>
    <?php
    foreach ($sequenceData as $semester => $courses)
    {
        ?>
        <h1><?php echo $semester; ?></h1>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >

            <?php
            foreach ($courses as $i => $course)
            {
                foreach ($schedule as $id => $courseData)
                {
                    if ($semester == $courseData["semester"] && $course == $courseData["course_code"])
                    {
                        ?>
                        <thead>
                        <tr>
                            <th>Lecture</th>
                            <th>Course</th>
                            <th>Section</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Days</th>
                            <th>&nbsp;</th>
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
                                <table>
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
                                            <td><input name="subsectionID[]" id="subsectionID[]" type="checkbox" data-sectionid="<?php echo $id;?>" value="<?php echo $subsectionID ;?>"></td>
                                        </tr>
                                        <?php
                                    } ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                        <?php
                    }
                }
            } ?>
        </table>
        <?php
    }

}
?>
