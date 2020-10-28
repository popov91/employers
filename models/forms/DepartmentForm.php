<?php

use yii\base\Model;

class DepartmentForm extends Model
{
    public string $name;

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