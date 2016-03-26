<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 3/26/2016
 * Time: 1:07 AM
 */
Yii::app()->clientScript->registerCssFile('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css');
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCoreScript('moment');
Yii::app()->clientScript->registerCoreScript('fullcalendar');


?>

<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.css">
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.print.css">

<script>
    $('#calendar').fullCalendar({
        events : [
            {
                title : 'Testing stuff out',
                start: '2016-01-01T17:30:00'
            }
        ]
    });
</script>