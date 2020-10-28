<?php

use app\models\Employer;
use yii\base\Model;

class EmployerForm extends Model
{
    public string $name;
    public string $surname;
    public string $patronymic;
    public int $gender;
    public int $salary;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'gender', 'salary'], 'required'],
            [['gender', 'salary'], 'integer'],
            [['name', 'surname', 'patronymic'], 'string', 'max' => 30],
            ['gender', 'in', 'range' => array_keys(Employer::getGenderVariants())],
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