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

		$okdays = array(); // days selected
		$nodays = array(); // days not selected
		$sql = "SELECT section.ID AS LECTURE_id,
			section.days AS LECTURE_days,
			section.start_time AS LECTURE_start_time,
			section.end_time AS LECTURE_end_time,
			section.sections AS LECTURE_section,
			section.semester AS LECTURE_semester,
			subsection.ID AS TUT_LAB_id,
			subsection.days AS TUT_LAB_days,
			subsection.sections AS TUT_LAB_section,
			subsection.start_time AS TUT_LAB_start_time,
			subsection.end_time AS TUT_LAB_end_time,
			subsection.kind AS TUT_LAB_kind,
			course.*
				FROM section
				LEFT JOIN subsection ON subsection.sectionID = section.ID AND subsection.semester=section.semester
				LEFT JOIN course ON section.courseID=course.ID";
		//which days were selected?
		($model->dayM == 1 ? $okdays['M'] = array("start_time"=>$model->fromTimeM, "end_time"=>"") : $nodays[] = 'M' );
		($model->dayT == 1 ? $okdays['T'] = array("start_time"=>$model->fromTimeT, "end_time"=>"") : $nodays[] = 'T' );
		($model->dayW == 1 ? $okdays['W'] = array("start_time"=>$model->fromTimeW, "end_time"=>"") : $nodays[] = 'W' );
		($model->dayJ == 1 ? $okdays['J'] = array("start_time"=>$model->fromTimeJ, "end_time"=>"") : $nodays[] = 'J' );
		($model->dayF == 1 ? $okdays['F'] = array("start_time"=>$model->fromTimeF, "end_time"=>"") : $nodays[] = 'F' );


		// build sql query
		$msearches = array();
		$nsearches = array();

		foreach($okdays as $day => $start_end_times)
		{
			$pat[":$day"] = '%'.$day.'%';
			$msearches[] = " (section.days like :$day AND subsection.days LIKE :$day AND section.start_time>='".$start_end_times['start_time']."' AND subsection.start_time>='".$start_end_times['start_time']."') ";
		}
		foreach($nodays as $day)
		{
			$pat[":$day"] = '%'.$day.'%';
			$nsearches[] = " (section.days NOT LIKE :$day AND subsection.days NOT LIKE :$day) ";
		}
		if(!empty($okdays))
		{
			$sql .= " WHERE (";
			$sql .= implode(" OR ", $msearches);
			$sql .= ")";
			if(!empty($nodays))
			{
				$sql .= " AND (";
				$sql .= implode(" AND ", $nsearches);
				$sql .= ")";
			}
		}



		// get lectures
		$command = Yii::app()->db->createCommand($sql);
		$data = $command->query($pat); // query with placeholders
		$lectures = $data->readAll(); // an array of all filtered lectures with given dates


		echo $sql;

		// here, we need to further filter $lectures to make sure there is no time overlap etc.



		$this->render('_gen', array(
				'model'=> $model,
				'lectures' => $lectures,
			)
		);
	}

}