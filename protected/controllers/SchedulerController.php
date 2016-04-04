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

	public function actionViewSaved()
	{
		$sql = "
				SELECT


									user_schedules.date_created,
									user_schedules.userID,
									user_schedule.scheduleID AS saveId,
									user_schedule.courseID AS courseID,
									user_schedule.sectionID AS lecture_id,
									user_schedule.subsectionID,
									user_schedule.year,



									subsection.kind AS sub_kind,
									subsection.days AS sub_days,
									subsection.start_time AS sub_start_time,
									subsection.end_time AS sub_end_time,
									subsection.sections AS sub_section_name,
									subsection.kind AS sub_kind,
									subsection.semester,

									section.ID AS lecture_id,
									section.kind AS section_kind,
									section.sections AS section_name,
									section.days AS lecture_days,
									section.start_time AS lecture_start_time,
									section.end_time AS lecture_end_time,

									course.course_code,
									course.ctype,
									course.credits,
									course.course_description
				FROM `user_schedule`
					LEFT JOIN user_schedules ON user_schedule.scheduleID = user_schedules.ID
					LEFT JOIN section ON section.ID = user_schedule.sectionID
					LEFT JOIN subsection ON subsection.ID = user_schedule.subsectionID
					LEFT JOIN course ON course.ID = user_schedule.courseID
														 WHERE userID= :userID 	";

		$pat[":userID"] =  Yii::app()->user->userID;

		$command = Yii::app()->db->createCommand($sql);
		$data = $command->query($pat); // query with placeholders
		$uSchedule = $data->readAll(); // an array of all filtered lectures with given dates

		$sched= array();

		//print_r($uSchedule);
		//exit;

		foreach($uSchedule as $i => $schedule)
		{
			$saveID = $schedule['saveId'];
			$save = &$sched[$saveID];
			$save['date_created'] = $schedule['date_created'];
			$save['schedule'] = array();

			foreach ($uSchedule as $schedule_)
			{
				$year = $schedule_['year'];
				$semester = $schedule_['semester'];
				$save['schedule'][$year][$semester] = array();
			}
		}

		foreach($uSchedule as $i => $schedule)
		{
			foreach ($sched as $saveID => $saveData)
			{
				foreach ($saveData['schedule'] as $year => $semesters)
				{
					foreach ($semesters as $semester => $courses)
					{
						$course = &$sched[$saveID]['schedule'][$year][$semester];
						if ($schedule['semester'] == $semester && $schedule['year'] == $year)
						{
							$course[$schedule['courseID']]['course_code'] = $schedule['course_code'];
							$course[$schedule['courseID']]['course_description'] = $schedule['course_description'];
							$course[$schedule['courseID']]['lecture_days'] = $schedule['lecture_days'];
							$course[$schedule['courseID']]['lecture_id'] = $schedule['lecture_id'];
							$course[$schedule['courseID']]['section_kind'] = $schedule['section_kind'];
							$course[$schedule['courseID']]['section_name'] = $schedule['section_name'];
							$course[$schedule['courseID']]['lecture_start_time'] = $schedule['lecture_start_time'];
							$course[$schedule['courseID']]['lecture_end_time'] = $schedule['lecture_end_time'];
							$course[$schedule['courseID']]['credits'] = $schedule['credits'];
							$course[$schedule['courseID']]['labs'] = array();
						}
					}
				}
			}
		}


			foreach ($sched as $saveID => $saveData)
			{
				foreach ($saveData['schedule'] as $year => $yearData)
				{
					foreach ($yearData as $semester => $semesterData)
					{
						foreach ($semesterData as $courseID => $courseData)
						{
							$course = &$sched[$saveID]['schedule'][$year][$semester][$courseID];
							foreach($uSchedule as $i => $schedule)
							{
								if ($schedule['courseID'] == $courseID && $courseData['lecture_id'] == $schedule['lecture_id'] && $schedule['sub_kind'] != $courseData['section_kind'])
								{
									$lab = &$course['labs'][$schedule['subsectionID']];
									$lab['sub_kind'] = $schedule['sub_kind'];
									$lab['sub_section_name'] = $schedule['sub_section_name'];
									$lab['sub_days'] = $schedule['sub_days'];
									$lab['sub_start_time'] = $schedule['sub_start_time'];
									$lab['sub_end_time'] = $schedule['sub_end_time'];
								}
							}
						}

					}

				}
			}


		//print_r($sched);
		//print_r($uSchedule);

		///exit;

		$this->render('saved',array(
			'schedule'=>$sched,
		));

	}

	public function actionGenerate()
	{
		$model = new PreferenceForm();
		$model->attributes = Yii::app()->request->getPost('PreferenceForm');

		$okdays = array(); // days selected
		$nodays = array(); // days not selected
		$sql = "SELECT section.ID AS LECTURE_id,
			section.days AS LECTURE_days,
			section.start_time     AS LECTURE_start_time,
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

		$yearsToShow = array();


		($model->year1==1 ? $yearsToShow[] = 1 : "");
		($model->year2==1 ? $yearsToShow[] = 2 : "");
		($model->year3==1 ? $yearsToShow[] = 3 : "");
		($model->year4==1 ? $yearsToShow[] = 4 : "");

		$this->render('index', array(
				'model'=> $model,
				'schedule' => $schedule,
				'yearsToShow' =>$yearsToShow
			)
		);
	}


    public function actionScheduleValidation()
    {
		print_r("in ajax");
        $post_data = $_POST['myData'];
        $decodedData = json_decode($post_data, true);
        //$course = [[[]]];
		$course=[];
        $counter = 0;
        //Save the years associated to sections chosen

        foreach ($decodedData as $key) {
			$tutOrLab = null;
			$lec = null;
			$currentYear = null;
			foreach ($key as $id => $number) {
				if ($id == 'year') {
					$currentYear = $number;
				} elseif ($id == 'subsection') {
					$tutOrLab = Yii::app()->db->createCommand()
						->select('courseID,kind,days,start_time,end_time,semester')
						->from($id)
						->where('id=' . $number)
						->queryRow();
				} else
					$lec = Yii::app()->db->createCommand()
						->select('courseID,kind,days,start_time,end_time,semester')
						->from($id)
						->where('id=' . $number)
						->queryRow();

			}

			$lecture = new Lecture($lec['courseID'],$lec['kind'],$lec['days'],$lec['start_time'],$lec['end_time'],$lec['semester'],$currentYear);
			print_r($lecture->getDays());
			// WILL ACTUALLY DISPLAY SOMETHING
			$tutorial = new TutorialAndLab($tutOrLab['courseID'],$tutOrLab['kind'],$tutOrLab['days'],$tutOrLab['start_time'],$tutOrLab['end_time'],$tutOrLab['semester'],$currentYear);
		    $course[$counter] = new CourseObj($lecture,$tutorial);
			$counter++;

		}

             print_r($course[0]->getLecture()->getDays());
		//Fatal Error in calling getDays


		$courseYear1Fall = [];
		$courseYear1Winter = [];
		$courseYear2Fall = [];
		$courseYear2Winter = [];
		$courseYear3Fall = [];
		$courseYear3Winter = [];
		$courseYear4Fall = [];
		$courseYear4Winter = [];
		$error = [];

		for($i=0; $i<=count($course); $i++){
			if ($course[$i]->getLecture() -> getYear() == 1) {
				if ($course[$i]->getLecture() -> getSemester() == 'F') {

						array_push($courseYear1Fall,$course[$i]);

				} elseif ($course[$i]->getLecture()->getSemester() == 'W') {

						array_push($courseYear1Winter,$course[$i]);
				}
			} elseif ($course[$i]->getLecture()->getYear() == 2) {

				if ($course[$i]->getLecture()->getSemester() == 'F') {

						array_push($courseYear2Fall,$course[$i]);

				} elseif ($course[$i]->getLecture()->getSemester() == 'W')

						array_push($courseYear2Winter,$course[$i]);

			} elseif ($course[$i]->getLecture()->getYear() == 3) {
				if ($course[$i]->getLecture()->getSemester() == 'F') {

						array_push($courseYear3Fall,$course[$i]);

				} elseif ($course[$i]->getLecture() -> getSemester() == 'W') {

						array_push($courseYear3Winter,$course[$i]);

				}

			} elseif ($course[$i]->getLecture()->getYear() == 4) {

				if ($course[$i]->getLecture()->getSemester() == 'F') {

						array_push($courseYear4Fall,$course[$i]);

				} elseif ($course[$i]->getLecture()->getSemester() == 'W') {

						array_push($courseYear4Winter,$course[$i]);
				}
			}
		}


			$this->renderPartial('_ajax', array(
					'data' => $post_data,
				)
			);


    }

	/**
	 * Performs the AJAX validation.
	 * @param Course $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='preference_form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}