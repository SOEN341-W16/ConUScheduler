<?php

/**
 * This is the model class for table "section".
 *
 * The followings are the available columns in table 'section':
 * @property integer $ID
 * @property integer $courseID
 * @property string $kind
 * @property string $sections
 * @property string $days
 * @property string $start_time
 * @property string $end_time
 * @property string $semester
 */
class Section extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'section';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('courseID', 'required'),
            array('courseID', 'numerical', 'integerOnly' => true),
            array('kind', 'length', 'max' => 3),
            array('sections', 'length', 'max' => 4),
            array('days', 'length', 'max' => 2),
            array('start_time, end_time', 'length', 'max' => 5),
            array('semester', 'length', 'max' => 6),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, courseID, kind, sections, days, start_time, end_time, semester', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'course' => array(self::HAS_ONE, 'Course', 'ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'ID'         => 'ID',
            'courseID'   => 'Course',
            'kind'       => 'Kind',
            'sections'   => 'Sections',
            'days'       => 'Days',
            'start_time' => 'Start Time',
            'end_time'   => 'End Time',
            'semester'   => 'Semester',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ID', $this->ID);
        $criteria->compare('courseID', $this->courseID);
        $criteria->compare('kind', $this->kind, true);
        $criteria->compare('sections', $this->sections, true);
        $criteria->compare('days', $this->days, true);
        $criteria->compare('start_time', $this->start_time, true);
        $criteria->compare('end_time', $this->end_time, true);
        $criteria->compare('semester', $this->semester, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Section the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
