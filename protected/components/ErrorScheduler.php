<?php

/**
 * Created by PhpStorm.
 * User: lec_marc
 * Date: 2016-04-13
 * Time: 11:18 AM
 */
class ErrorScheduler
{
    private $ID;
    private $sectionID;

    function __construct($ID, $sectionID){
        $this->ID = $ID;
        $this->sectionID=$sectionID;
    }
}