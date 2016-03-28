<?php

/**
 * Created by PhpStorm.
 * User: lec_marc
 * Date: 2016-03-28
 * Time: 2:46 AM
 */
require('Lecture.php');
class Course
{
  private  $lecture;
  private  $tutorial;

    function _construct($lec, $tutorial){
        $this->lecture = $lec;
        $this->tutorial = $tutorial;
    }

}