<?php

/**
 * Created by PhpStorm.
 * User: lec_marc
 * Date: 2016-03-28
 * Time: 2:44 AM
 */
class TutorialAndLab
{
    private $days;
    private $kind;
    private $courseId;
    private $startTime;
    private $endTime;
    private $semester;
    private $year;

    function  __construct($courseId, $kind,$days, $start, $end, $sem,$year){
        $this->courseId = $courseId;
        $this->kind= $kind;
        $this->days = $days;
        $this->startTime = $start;
        $this->endTime = $end;
        $this->semester = $sem;
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getDays()
    {
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSemester()
    {
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this;
    }

}
?>