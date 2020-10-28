<?php

namespace app\services;

use app\models\Employer;
use app\repositories\EmployerRepository;

class EmployerService
{
    private $employerRepository;

    public function __construct(EmployerRepository $employerRepository)
    {
        $this->employerRepository = $employerRepository;
    }

    public function create(string $name, string $surname, string $patronymic, int $gender, int $salary): void
    {
        $employer = Employer::create($name, $surname, $patronymic, $gender, $salary);
        $this->employerRepository->add($employer);
        //@todo добавить проверку связей
    }

    public function edit(string $id, string $name, string $surname, string $patronymic, int $salary): void
    {
        $employer = $this->employerRepository->find($id);
        $employer->edit($name, $surname, $patronymic, $salary);
        $this->employerRepository->save($employer);
        //@todo добавить сохранение связей
    }

    public function delete(string $id): void
    {
        $employer = $this->employerRepository->find($id);
        $this->employerRepository->delete($employer);
        //@todo добавить проверку связей
    }
}