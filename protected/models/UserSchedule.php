<?php

/**
 * This is the model class for table "user_schedule".
 *
 * The followings are the available columns in table 'user_schedule':
 * @property integer $ID
 * @property integer $scheduleID
 * @property integer $courseID
 * @property integer $sectionID
 * @property integer $subsectionID
 * @property integer $year
 */
class UserSchedule extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user_schedule';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('scheduleID, courseID, sectionID, subsectionID, year', 'required'),
            array('scheduleID, courseID, sectionID, subsectionID, year', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, scheduleID, courseID, sectionID, subsectionID, year', 'safe', 'on' => 'search'),
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
            'scheduleID' => array(self::BELONGS_TO, 'UserSchedules', 'ID')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'ID'           => 'ID',
            'scheduleID'   => 'Schedule',
            'courseID'     => 'Course',
            'sectionID'    => 'Section',
            'subsectionID' => 'Subsection',
            'year'         => 'Year',
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
        $criteria->compare('scheduleID', $this->scheduleID);
        $criteria->compare('courseID', $this->courseID);
        $criteria->compare('sectionID', $this->sectionID);
        $criteria->compare('subsectionID', $this->subsectionID);
        $criteria->compare('year', $this->year);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserSchedule the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
