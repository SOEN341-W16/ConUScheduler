<?php

class SchedulerController extends Controller
{
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


}