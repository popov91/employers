<?php

namespace app\models\forms;

use app\models\Department;
use yii\base\Model;

class DepartmentEditForm extends Model
{
    public $name;
    private $department;

    public function __construct(Department $department, $config = [])
    {
        $this->department = $department;
        $this->name = $department->name;
        parent::__construct($config);
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
            'name' => 'Наименование отдела',
        ];
    }
}