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

    public function findAll(): array
    {
        return $this->departmentRepository->findAll();
    }

    public function create(string $name): void
    {
        $department = Department::create($name);
        $this->departmentRepository->add($department);
    }

    public function edit(string $id, string $name): void
    {
        $department = $this->departmentRepository->find($id);
        $department->edit($name);
        $this->departmentRepository->save($department);
    }

    public function delete(string $id): void
    {
        $department = $this->departmentRepository->find($id);
        $this->departmentRepository->delete($department);
    }
}