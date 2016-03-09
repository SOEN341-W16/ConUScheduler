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
    public $dayR;
    public $dayF;
    public $dayS;
    public $dayU;
    public $fromTimeM;
    public $fromTimeT;
    public $fromTimeW;
    public $fromTimeR;
    public $fromTimeF;
    public $fromTimeS;
    public $fromTimeU;
    public $toTimeM;
    public $toTimeT;
    public $toTimeW;
    public $toTimeR;
    public $toTimeF;
    public $toTimeS;
    public $toTimeU;
    public function rules()
    {
        return array(
            array('dayM, dayT, dayW, dayR, dayF, dayS, dayU, fromTimeM, fromTimeT, fromTimeW, fromTimeR, fromTimeF, fromTimeS, fromTimeU, toTimeM, toTimeT, toTimeW, toTimeR, toTimeF, toTimeS, toTimeU', 'required'),
        );
    }
    public function attributeLabels()
    {
        return array(

            'dayM' => 'MON',
            'dayT' => 'TUE',
            'dayW' => 'WED',
            'dayR' => 'THU',
            'dayF' => 'FRI',
            'dayS' => 'SAT',
            'dayU' => 'SUN',
        );
    }
}

