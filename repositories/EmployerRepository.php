<?php

namespace app\repositories;

use app\models\Employer;
use app\models\EmployersLnkDepartments;
use app\repositories\exceptions\NotFoundException;

class EmployerRepository
{
    public function find(string $id)
    {
        if (!$employer = Employer::findOne($id)) {
            throw new NotFoundException('Запись не найдена.');
        }

        return $employer;
    }

    public function findAll()
    {
        return Employer::find()->all();
    }

    public function add(Employer $employer)
    {
        if (!$employer->getIsNewRecord()) {
            throw new \RuntimeException('Запись уже существует.');
        }
        if (!$employer->insert(false)) {
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }

    public function addRelations($employerId, $departmentsIds)
    {
        $this->removeRelations($employerId);
        foreach ($departmentsIds as $departmentsId) {
           $model = new EmployersLnkDepartments();
           $model->employer_id = $employerId;
           $model->department_id = $departmentsId;
           $model->save();
        }
    }

    private function removeRelations($id)
    {
        EmployersLnkDepartments::deleteAll(['employer_id' => $id]);
    }

    public function save(Employer $employer)
    {
        if ($employer->getIsNewRecord()) {
            throw new \RuntimeException('Невозможно сохранить новую запись.');
        }
        if ($employer->update(false) === false) {
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }

    public function delete(Employer $employer)
    {
        if (!$employer->delete()) {
            throw new \RuntimeException('Ошибка удаления.');
        }
    }

    public function checkRelations(string $id)
    {
        $employer = $this->find($id);

        return $employer->departments;
    }
}