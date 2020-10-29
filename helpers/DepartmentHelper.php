<?php

namespace app\helpers;

class DepartmentHelper
{
    public static function getDepartmentsList($departments)
    {
        $ids = [];
        $names = [];
        foreach ($departments as $department) {
            $ids[] = $department->id;
            $names[] = $department->name;
        }

        return array_combine($ids, $names);
    }
}