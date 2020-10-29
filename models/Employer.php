<?php

namespace app\models;

use app\helpers\EmployerHelper;
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
    const GENDER_MALE   = 0;
    const GENDER_FEMALE = 1;

    public static function create($name, $surname, $patronymic, $gender, $salary): self
    {
        $employer = new self;
        $employer->name = $name;
        $employer->surname = $surname;
        $employer->patronymic = $patronymic;
        $employer->gender = $gender;
        $employer->salary = $salary;

        return $employer;
    }

    public function edit($name, $surname, $patronymic, $gender, $salary)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->gender = $gender;
        $this->patronymic = $patronymic;
        $this->salary = $salary;
    }

    public function findAllDepartments()
    {
        $result = [];

        foreach ($this->departments as $department) {
            $result[] = $department->name;
        }

        return implode(',<br>', $result);
    }

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
            [['name', 'surname','salary'], 'required'],
            [['gender', 'salary'], 'integer'],
            [['name', 'surname', 'patronymic'], 'string', 'max' => 30],
            ['gender', 'in', 'range' => array_keys(EmployerHelper::getGenderList())],
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
