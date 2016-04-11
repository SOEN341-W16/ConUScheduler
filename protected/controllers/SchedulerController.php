<?php

class SchedulerController extends Controller
{
	public $layout='//layouts/column2';
	public function actionIndex()
	{
		$model = new PreferenceForm();
		// this is the stuff we pass into the view (index page)

		$this->render('index', array(
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

	public function actionGenerate()
	{
		$model = new PreferenceForm();

		$model->attributes = Yii::app()->request->getPost('PreferenceForm');

		$this->render('index', array(
				'model'=> $model
			)
		);
	}

}