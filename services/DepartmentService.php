<?php

namespace app\services;

use app\models\Department;
use app\repositories\DepartmentRepository;

class DepartmentService
{
    private $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function findAll()
    {
        return $this->departmentRepository->findAll();
    }

    public function create(string $name)
    {
        $department = Department::create($name);
        $this->departmentRepository->add($department);

        return $department;
    }

    public function edit(string $id, string $name)
    {
        $department = $this->departmentRepository->find($id);
        $department->edit($name);
        $this->departmentRepository->save($department);
    }

    public function delete(string $id)
    {
        $department = $this->departmentRepository->find($id);
        $relations = $this->departmentRepository->checkRelations($id);
        if (count($relations) > 0) {
            return false;
        }
        $this->departmentRepository->delete($department);

        return true;
    }
}