<?php

namespace app\services;

use app\repositories\DepartmentRepository;

class DepartmentCalculatorService
{
    private $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function getEmployersCount(string $id): ?int
    {
        return $this->departmentRepository->countEmployersById($id);
    }

    public function getMaxEmployersSalary($id): ?int
    {
        return $this->departmentRepository->getMaxSalaryById($id);
    }
}