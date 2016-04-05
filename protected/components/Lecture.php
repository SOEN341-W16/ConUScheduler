<?php

/**
 * Created by PhpStorm.
 * User: lec_marc
 * Date: 2016-03-29
 * Time: 11:54 AM
 */
class Lecture{
    private $courseId;
    private $kind;
    private $days;
    private $startTime;
    private $endTime;
    private $semester;
    private $year;




    function __construct($courseId, $kind,$days, $start, $end, $sem,$year){
        $this->courseId = $courseId;
        $this->kind = $kind;
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
        return $this->days;
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