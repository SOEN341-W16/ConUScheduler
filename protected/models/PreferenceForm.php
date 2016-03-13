<?php

/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 3/5/2016
 * Time: 1:13 AM
 */
// this class contains the form data. We're extending from CFormModel since the data lives within a form instead of a database table
class PreferenceForm extends CFormModel
{

    public $dayM;
    public $dayT;
    public $dayW;
    public $dayJ;
    public $dayF;
    public $fromTimeM;
    public $fromTimeT;
    public $fromTimeW;
    public $fromTimeJ;
    public $fromTimeF;
    public $toTimeM;
    public $toTimeT;
    public $toTimeW;
    public $toTimeJ;
    public $toTimeF;
    public function rules()
    {
        return array(
            array('dayM, dayT, dayW, dayJ, dayF, fromTimeM, fromTimeT, fromTimeW, fromTimeJ, fromTimeF,toTimeM, toTimeT, toTimeW, toTimeJ, toTimeF', 'required'),
        );
    }
    public function attributeLabels()
    {
        return array(

            'dayM' => 'MON',
            'dayT' => 'TUE',
            'dayW' => 'WED',
            'dayJ' => 'THU',
            'dayF' => 'FRI',
        );
    }
}

