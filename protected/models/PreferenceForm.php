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

    public $year1;

    public $year2;

    public $year3;

    public $year4;

    public function rules()
    {
        return array(
            array('dayM, dayT, dayW, dayJ, dayF, fromTimeM, fromTimeT, fromTimeW, fromTimeJ, fromTimeF,toTimeM, toTimeT, toTimeW, toTimeJ, toTimeF, year1, year2, year3, year4', 'required'),
        );
    }

    public function attributeLabels()
    {
        return array(

            'dayM'  => 'MON',
            'dayT'  => 'TUE',
            'dayW'  => 'WED',
            'dayJ'  => 'THU',
            'dayF'  => 'FRI',
            'year1' => 'Year 1',
            'year2' => 'Year 2',
            'year3' => 'Year 3',
            'year4' => 'Year 4'
        );
    }
}

