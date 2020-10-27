<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int $employer_id Идентификатор сотрудника
 * @property int $department_id Идентификатор отдела
 *
 * @property Department $department
 * @property Employer $employer
 */
class EmployersLnkDepartments extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employers_lnk_departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employer_id', 'department_id'], 'required'],
            [['employer_id', 'department_id'], 'integer'],
            [['employer_id', 'department_id'], 'unique', 'targetAttribute' => ['employer_id', 'department_id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['employer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employer::className(), 'targetAttribute' => ['employer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'employer_id' => 'Идентификатор сотрудника',
            'department_id' => 'Идентификатор отдела',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * Gets query for [[Employer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployer()
    {
        return $this->hasOne(Employer::className(), ['id' => 'employer_id']);
    }
}
