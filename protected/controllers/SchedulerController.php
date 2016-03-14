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
	function array_merge_recursive_new() {

		$arrays = func_get_args();
		$base = array_shift($arrays);

		foreach ($arrays as $array) {
			reset($base); //important
			while (list($key, $value) = @each($array)) {
				if (is_array($value) && @is_array($base[$key])) {
					$base[$key] = array_merge_recursive_new($base[$key], $value);
				} else {
					$base[$key] = $value;
				}
			}
		}

		return $base;
	}
	public function actionGenerate()
	{
		$model = new PreferenceForm();
		$model->attributes = Yii::app()->request->getPost('PreferenceForm');

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
				LEFT JOIN course ON section.courseID=course.ID ";
		//which days were selected?
		($model->dayM == 1 ? $okdays['M'] = array("start_time"=>$model->fromTimeM, "end_time"=> $model->toTimeM) : $nodays[] = 'M' );
		($model->dayT == 1 ? $okdays['T'] = array("start_time"=>$model->fromTimeT, "end_time"=> $model->toTimeT) : $nodays[] = 'T' );
		($model->dayW == 1 ? $okdays['W'] = array("start_time"=>$model->fromTimeW, "end_time"=> $model->toTimeW) : $nodays[] = 'W' );
		($model->dayJ == 1 ? $okdays['J'] = array("start_time"=>$model->fromTimeJ, "end_time"=> $model->toTimeJ) : $nodays[] = 'J' );
		($model->dayF == 1 ? $okdays['F'] = array("start_time"=>$model->fromTimeF, "end_time"=> $model->toTimeF) : $nodays[] = 'F' );


		// build sql query
		$msearches = array();
		$nsearches = array();

		foreach($okdays as $day => $start_end_times)
		{
			$pat[":$day"] = '%'.$day.'%';
			$pat[":start_$day"] = $start_end_times['start_time'];
			$pat[":end_$day"] = $start_end_times['end_time'];
			$msearches[] = "
			(section.days like :$day
				AND subsection.days LIKE :$day
				AND section.start_time>=:start_$day
				AND subsection.start_time>=:start_$day
				AND section.end_time<=:end_$day
				AND subsection.end_time<=:end_$day
			) ";
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


		$sql .= " ORDER BY course.course_code ASC ";


		// get lectures
		$command = Yii::app()->db->createCommand($sql);
		$data = $command->query($pat); // query with placeholders
		$lectures = $data->readAll(); // an array of all filtered lectures with given dates



		$schedule = array();
		foreach($lectures as $i =>$lectureData)
		{
			$sectionId = $lectureData["LECTURE_id"];
		//	$schedule[$sectionId]["labs_tut"] = array();

			$schedule[$sectionId]["course_code"] = $lectureData["course_code"];
			$schedule[$sectionId]["days"] = $lectureData["LECTURE_days"];
			$schedule[$sectionId]["semester"]= $lectureData["LECTURE_semester"];
			$schedule[$sectionId]["start_time"] = $lectureData["LECTURE_start_time"];
			$schedule[$sectionId]["end_time"] = $lectureData["LECTURE_end_time"];
			$schedule[$sectionId]["section"] = $lectureData["LECTURE_section"];
			$schedule[$sectionId]["course_type"] = $lectureData["cType"];
			$schedule[$sectionId]["description"] = $lectureData["course_description"];


			$subsectionId = $lectureData["TUT_LAB_id"];
			$schedule[$sectionId]["labs_tut"][$subsectionId] = array(
				"days" => $lectureData["TUT_LAB_days"],
				"section" => $lectureData["TUT_LAB_section"],
				"start_time" => $lectureData["TUT_LAB_start_time"],
				"end_time" => $lectureData["TUT_LAB_end_time"],
				"kind" => $lectureData["TUT_LAB_kind"]
			);



		}
		// here, we need to further filter $lectures to make sure there is no time overlap etc.

		//print_r($schedule);

		$this->render('index', array(
				'model'=> $model,
				'schedule' => $schedule,
			)
		);
	}

}