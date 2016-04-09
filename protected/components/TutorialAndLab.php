<?php

/**
 * Created by PhpStorm.
 * User: lec_marc
 * Date: 2016-03-28
 * Time: 2:44 AM
 */
class TutorialAndLab extends CApplicationComponent
{
    private $days;
    private $kind;
    private $courseId;
    private $startTime;
    private $endTime;
    private $semester;
    private $year;


    public function __construct($courseId, $kind,$days,$start, $end, $sem,$year){
        $this->courseId = $courseId;
        $this->kind = $kind;
        $this->days = $days;
        $this->startTime =(int)$start;
        $this->endTime = (int)$end;
        $this->semester = $sem;
        $this->year = (int)$year;
    }


    /**
     * @return mixed
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @return mixed
     */
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

}
?>