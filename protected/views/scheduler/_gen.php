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
    foreach($lectures as $i => $lectureData) { ?>
        <tr>
            <th><?php echo $lectureData["LECTURE_id"]?></th>
            <th><?php echo $lectureData["course_code"];?></th>
            <th><?php echo $lectureData["LECTURE_section"];?></th>
            <th><?php echo $lectureData["LECTURE_days"];?></th>
            <th><?php echo $lectureData["LECTURE_start_time"];?></th>
            <th><?php echo $lectureData["LECTURE_end_time"];?></th>
            <th><?php echo $lectureData["LECTURE_semester"];?></th>
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
                    <tr>
                        <td><?php echo $lectureData["TUT_LAB_kind"];?></td>
                        <td><?php echo $lectureData["TUT_LAB_section"];?></td>
                        <td><?php echo $lectureData["TUT_LAB_days"];?></td>
                        <td><?php echo $lectureData["TUT_LAB_start_time"];?></td>
                        <td><?php echo $lectureData["TUT_LAB_end_time"];?></td>
                    </tr>

                    </tbody>

                </table>
            </td>
        </tr>
        <?php
    }?>
    </tbody>  

</table>