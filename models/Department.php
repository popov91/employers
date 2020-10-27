<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int $id Идентификатор
 * @property string $name Наименование отдела
 *
 * @property EmployersLnkDepartments[] $employersLnkDepartments
 * @property Employer[] $employers
 */
class Department extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'name' => 'Наименование отдела',
        ];
    }

    /**
     * Gets query for [[EmployersLnkDepartments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployersLnkDepartments()
    {
        return $this->hasMany(EmployersLnkDepartments::className(), ['department_id' => 'id']);
    }

    /**
     * Gets query for [[Employers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployers()
    {
        return $this->hasMany(Employer::className(), ['id' => 'employer_id'])->viaTable('employers_lnk_departments', ['department_id' => 'id']);
    }
}
