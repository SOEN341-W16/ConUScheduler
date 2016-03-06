<?php

/**
 * Created by PhpStorm.
 * User: Server
 * Date: 3/6/2016
 * Time: 11:44 AM
 */
class ProfileController extends Controller
{

    public $layout='//layouts/column2';

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionRecord()
    {
        $model = new CompletedCourses();
        $this->render('record',
            array(
                'model'=> $model
            )
        );
    }


    public function filters()
    {
        return array(
            'accessControl',
        );
    }
}