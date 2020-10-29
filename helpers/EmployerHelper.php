<?php

namespace app\helpers;

use app\models\Employer;
use yii\helpers\ArrayHelper;

class EmployerHelper
{
    public static function getGenderList(): array
    {
        return [
            Employer::GENDER_MALE   => 'Мужчина',
            Employer::GENDER_FEMALE => 'Женщина',
        ];
    }

    public static function getGenderName($gender): string
    {
        return ArrayHelper::getValue(self::getGenderList(), $gender);
    }

    public static function getFullName(Employer $employer): string
    {
        return "$employer->name $employer->patronymic $employer->surname";
    }
}