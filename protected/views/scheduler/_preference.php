<div class="preference_form">
    <?php $form = $this->beginWidget('CActiveForm'); ?>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php $timeArray = array('8:45:00', '10:15:00'      => '10:15:00', '10:30:00' => '10:30:00',
                                 '10:45:00'                 => '10:45:00', '11:00:00' => '11:00:00', '11:15:00' => '11:15:00', '11:30:00' => '11:30:00', '11:45:00' =>
                                     '11:45:00', '12:00:00' => '12:00:00', '12:15:00' => '12:15:00', '12:30:00' => '12:30:00', '12:45:00' => '12:45:00',
                                 '13:00:00'                 => '13:00:00', '13:15:00' => '13:15:00', '13:30:00' => '13:30:00', '13:45:00' => '13:45:00', '14:00:00' =>
                                     '14:00:00', '14:15:00' => '14:15:00', '14:30:00' => '14:30:00', '14:45:00' => '14:45:00', '15:00:00' => '15:00:00',
                                 '15:15:00'                 => '15:15:00', '15:30:00' => '15:30:00', '15:45:00' => '15:45:00', '16:00:00' => '16:00:00', '16:15:00' =>
                                     '16:15:00', '16:30:00' => '16:30:00', '16:45:00' => '16:45:00', '17:00:00' => '17:00:00', '17:15:00' =>
                                     '17:15:00', '17:30:00' => '17:30:00', '17:45:00' => '17:45:00', '18:00:00' => '18:00:00', '18:15:00' =>
                                     '18:15:00', '18:30:00' => '18:30:00', '18:45:00' => '18:45:00', '19:00:00' => '19:00:00', '19:15:00' =>
                                     '19:15:00', '19:30:00' => '19:30:00', '19:45:00' => '19:45:00', '20:00:00' => '20:00:00', '20:15:00' => '20:15:00', '21:30:00', '22:00:00', '23:30:00'); ?>

    </div>
    <br/>


    <div class="row">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <thead>
            <th></th>
            <th>Day</th>
            <th>Start Time</th>
            <th>End Time</th>
            </thead>
            <tbody>

            <tr>
                <td><?php echo $form->checkBox($model, 'dayM') ?></td>
                <td><?php echo $form->label($model, 'dayM'); ?></td>
                <td><?php echo $form->dropDownList($model, 'fromTimeM', $timeArray, array('empty' => '(Select a time)')); ?></td>
                <td><?php echo $form->dropDownList($model, 'toTimeM', $timeArray, array('empty' => '(Select a time)')); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->checkBox($model, 'dayT') ?></td>
                <td><?php echo $form->label($model, 'dayT'); ?></td>
                <td><?php echo $form->dropDownList($model, 'fromTimeT', $timeArray, array('empty' => '(Select a time)')); ?></td>
                <td><?php echo $form->dropDownList($model, 'toTimeT', $timeArray, array('empty' => '(Select a time)')); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->checkBox($model, 'dayW') ?></td>
                <td><?php echo $form->label($model, 'dayW'); ?></td>
                <td><?php echo $form->dropDownList($model, 'fromTimeW', $timeArray, array('empty' => '(Select a time)')); ?></td>
                <td><?php echo $form->dropDownList($model, 'toTimeW', $timeArray, array('empty' => '(Select a time)')); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->checkBox($model, 'dayJ') ?></td>
                <td><?php echo $form->label($model, 'dayJ'); ?></td>
                <td><?php echo $form->dropDownList($model, 'fromTimeJ', $timeArray, array('empty' => '(Select a time)')); ?></td>
                <td><?php echo $form->dropDownList($model, 'toTimeJ', $timeArray, array('empty' => '(Select a time)')); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->checkBox($model, 'dayF') ?></td>
                <td><?php echo $form->label($model, 'dayF'); ?></td>
                <td><?php echo $form->dropDownList($model, 'fromTimeF', $timeArray, array('empty' => '(Select a time)')); ?></td>
                <td><?php echo $form->dropDownList($model, 'toTimeF', $timeArray, array('empty' => '(Select a time)')); ?></td>
            </tr>
            </tbody>
        </table>
        <strong>Years to show: </strong>
        <?php echo $form->label($model, 'year1') . ' ' . $form->checkBox($model, 'year1') . ' ' . $form->label($model, 'year2') . ' ' . $form->checkBox($model, 'year2') .
            ' ' . $form->label($model, 'year3') . ' ' . $form->checkBox($model, 'year3') .
            ' ' . $form->label($model, 'year4') . ' ' . $form->checkBox($model, 'year4'); ?>


    </div>
    <br>
    <div class="row buttons">
        <?php echo CHtml::button('Generate Schedule', array('submit' => array('scheduler/generate'))); ?>
    </div>


    <?php $this->endWidget(); ?>
</div>