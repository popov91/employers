<?php

namespace app\services;

use app\models\Employer;
use app\repositories\EmployerRepository;
use app\services\structures\EmployerData;

class EmployerService
{
    private $employerRepository;

    public function __construct(EmployerRepository $employerRepository)
    {
        $this->employerRepository = $employerRepository;
    }

    public function findAll(): array
    {
        return $this->employerRepository->findAll();
    }

    public function create(EmployerData $employerData, $departments)
    {
        $employer = Employer::create(
            $employerData->name,
            $employerData->surname,
            $employerData->patronymic,
            $employerData->gender,
            $employerData->salary,
        );
        $this->employerRepository->add($employer);
        $this->employerRepository->addRelations($employer->id, $departments);
    }

    public function edit($id, EmployerData $employerData, $departments)
    {
        $employer = $this->employerRepository->find($id);
        $employer->edit(
            $employerData->name,
            $employerData->surname,
            $employerData->patronymic,
            $employerData->gender,
            $employerData->salary
        );
        $this->employerRepository->save($employer);
        $this->employerRepository->addRelations($employer->id, $departments);
    }

    public function delete(string $id)
    {
        $employer = $this->employerRepository->find($id);
        $relations = $this->employerRepository->checkRelations($id);

        if (count($relations) > 0) {
            return false;
        }
        $this->employerRepository->delete($employer);

        return true;
    }
}