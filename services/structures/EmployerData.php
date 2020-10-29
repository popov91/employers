<?php

namespace app\services\structures;

class EmployerData
{
    public $name;
    public $surname;
    public $patronymic;
    public $gender;
    public $salary;

    public function __construct($name, $surname, $patronymic, $gender, $salary)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->patronymic = $patronymic;
        $this->gender = $gender;
        $this->salary = $salary;
    }
}