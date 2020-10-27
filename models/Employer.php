<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int $id Идентификатор
 * @property string $name Имя
 * @property string $surname Фамилия
 * @property string $patronymic Отчество
 * @property int $gender Пол
 * @property int $salary Зарплата
 *
 * @property EmployersLnkDepartments[] $employersLnkDepartments
 * @property Department[] $departments
 */
class Employer extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'gender', 'salary'], 'required'],
            [['gender', 'salary'], 'integer'],
            [['name', 'surname', 'patronymic'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'gender' => 'Пол',
            'salary' => 'Зарплата',
        ];
    }

    /**
     * Gets query for [[EmployersLnkDepartments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployersLnkDepartments()
    {
        return $this->hasMany(EmployersLnkDepartments::className(), ['employer_id' => 'id']);
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['id' => 'department_id'])->viaTable('employers_lnk_departments', ['employer_id' => 'id']);
    }
}
