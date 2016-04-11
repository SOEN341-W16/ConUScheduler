<?php

/**
 * This is the model class for table "course".
 *
 * The followings are the available columns in table 'course':
 * @property integer $ID
 * @property string $course_code
 * @property string $course_description
 * @property string $cType
 * @property string $credits
 */
class Course extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'course';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cType, credits, course_description, course_code', 'required'),
            array('ID', 'numerical', 'integerOnly' => true),
            array('course_code', 'length', 'max' => 10),
            array('course_description', 'length', 'max' => 55),
            array('cType', 'length', 'max' => 10),
            array('credits', 'length', 'max' => 4),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, course_code, course_description, cType, credits', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'ID'                 => 'ID',
            'course_code'        => 'Course Code',
            'course_description' => 'Course Description',
            'cType'              => 'Course Type',
            'credits'            => 'Credits',
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
        $criteria->compare('course_code', $this->course_code, true);
        $criteria->compare('course_description', $this->course_description, true);
        $criteria->compare('cType', $this->cType, true);
        $criteria->compare('credits', $this->credits, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Course the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
