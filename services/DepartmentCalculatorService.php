<?php

namespace app\services;

use app\models\Department;
use app\repositories\DepartmentRepository;

class DepartmentCalculatorService
{
    private $department;
    private $departmentRepository;

    public function __construct(Department $department, DepartmentRepository $departmentRepository)
    {
        $this->department = $department;
        $this->departmentRepository = $departmentRepository;
    }

    public function getEmployersCount(): ?int
    {
        return $this->departmentRepository->countEmployersById($this->department->id);
    }

    public function getMaxEmployersSalary(): ?int
    {
        return $this->departmentRepository->getMaxSalaryById($this->department->id);
    }
}