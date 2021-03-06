<?php

namespace app\models\forms;

use app\helpers\EmployerHelper;
use yii\base\Model;

class EmployerForm extends Model
{
    public $name;
    public $surname;
    public $patronymic;
    public $gender;
    public $salary;
    public $departments;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'salary', 'departments'], 'required'],
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
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'gender' => 'Пол',
            'salary' => 'Зарплата',
        ];
    }
}