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

		$Section = new Section();
		$Prerequisite = new Prerequisite();

		$okdays = array();
		$nodays = array();
		$sql = 'SELECT * FROM sections WHERE ';
		($model->dayM == 1 ? $okdays[] = 'M' : $nodays[] = 'M' );
		($model->dayT == 1 ? $okdays[] = 'T' : $nodays[] = 'T' );
		($model->dayW == 1 ? $okdays[] = 'W' : $nodays[] = 'W' );
		($model->dayJ == 1 ? $okdays[] = 'J' : $nodays[] = 'J' );
		($model->dayF == 1 ? $okdays[] = 'F' : $nodays[] = 'F' );

		//$a = implode()
		foreach($okdays as $place => $day)
		{
			$sql .= " days LIKE '%".$place."%'";
		}



		$prerequisiteCriteria = new CDbCriteria;
		$prerequisiteCriteria->select = '*';
		$prerequisites = $Prerequisite->findAll($prerequisiteCriteria);




		$this->render('index', array(
				'model'=> $model,
				'sections' => $sections,
			)
		);
	}

}