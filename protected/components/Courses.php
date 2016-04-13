<?php

/**
 * Created by PhpStorm.
 * User: lec_marc
 * Date: 2016-03-28
 * Time: 2:46 AM
 */
class Courses
{
    private  $lecture;
    private  $tutorial;

    public function __construct(Lecture $lec, TutorialAndLab $tutorial){
        $this->lecture = $lec;
        $this->tutorial = $tutorial;

    }

    /**
     * @return mixed
     */

    public function getLecture()
    {
        return $this->lecture;
    }

    /**
     * @param mixed $lecture
     */
    public function setLecture($lecture)
    {
        $this->lecture = $lecture;
    }

    /**
     * @return mixed
     */
    public function getTutorial()
    {
        return $this->tutorial;
    }

    /**
     * @param mixed $tutorial
     */
    public function setTutorial($tutorial)
    {
        $this->tutorial = $tutorial;
    }



}
?>