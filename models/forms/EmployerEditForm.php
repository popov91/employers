<?php

namespace app\models\forms;

use yii\base\Model;
use app\helpers\EmployerHelper;
use app\models\Employer;

class EmployerEditForm extends Model
{
    public $name;
    public $surname;
    public $patronymic;
    public $gender;
    public $salary;
    public $departments;

    private $employer;

    public function __construct(Employer $employer, $config = [])
    {
        $this->employer = $employer;
        $this->name = $employer->name;
        $this->surname = $employer->surname;
        $this->patronymic = $employer->patronymic;
        $this->gender = $employer->gender;
        $this->salary = $employer->salary;
        $this->departments = $employer->departments;

        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'salary'], 'required'],
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