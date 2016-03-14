
<table>
    <thead>
    <th>Lecture ID</th>
    <th>Course</th>
    <th>Course Section</th>
    <th>Days</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>Semester</th>
    <th>Year</th>
    </thead>
    
    <tbody>
    <?php
    foreach($schedule as $id => $scheduleData) { ?>
        <tr>
            <th><?php echo $id; ?></th>
            <th><?php echo $scheduleData["course_code"];?></th>
            <th><?php echo $scheduleData["section"];?></th>
            <th><?php echo $scheduleData["days"];?></th>
            <th><?php echo $scheduleData["start_time"];?></th>
            <th><?php echo $scheduleData["end_time"];?></th>
            <th><?php echo $scheduleData["semester"];?></th>
            <th></th>
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

                    foreach($scheduleData["labs_tut"] as $labdata)
                    {
                    ?>
                    <tr>
                        <td><?php echo $labdata["kind"];?></td>
                        <td><?php echo $labdata["section"];?></td>
                        <td><?php echo $labdata["days"];?></td>
                        <td><?php echo $labdata["start_time"];?></td>
                        <td><?php echo $labdata["end_time"];?></td>
                    </tr>
                    <?php
                    } ?>

                    </tbody>

                </table>
            </td>
        </tr>
        <?php
    }?>
    </tbody>  

</table>