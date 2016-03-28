<?php

/**
 * Created by PhpStorm.
 * User: lec_marc
 * Date: 2016-03-28
 * Time: 2:44 AM
 */
class Lecture
{
    private $days;
    private $startTime;
    private $endTime;
    private $semester;
    private $year;

    function __construct() {
        $argv = func_get_args();
        switch( func_num_args() ) {
            case 1:
                self::__construct1();
                break;
            case 2:
                self::__construct2( $argv[0], $argv[1],$argv[2],$argv[3],$argv[4],$argv[5],argv[6] );
                break;
        }
    }

    function __construct1() {

    }


    function __construct2($courseId, $kind,$days, $start, $end, $sem,$year){
        $this->days = $courseId;
        $this->kind = $kind;
        $this->kind = $days;
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