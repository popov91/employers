<?php

namespace app\repositories;

use app\models\Employer;
use app\repositories\exceptions\NotFoundException;

class EmployerRepository
{
    public function find(string $id): Employer
    {
        if (!$employer = Employer::findOne($id)) {
            throw new NotFoundException('Запись не найдена.');
        }

        return $employer;
    }

    public function findAll(): array
    {
        return Employer::find()->all();
    }

    public function add(Employer $employer): void
    {
        if (!$employer->getIsNewRecord()) {
            throw new \RuntimeException('Запись уже существует.');
        }
        if (!$employer->insert(false)) {
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }

    public function save(Employer $employer): void
    {
        if ($employer->getIsNewRecord()) {
            throw new \RuntimeException('Невозможно сохранить новую запись.');
        }
        if ($employer->update(false) === false) {
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }

    public function delete(Employer $employer): void
    {
        if (!$employer->delete()) {
            throw new \RuntimeException('Ошибка удаления.');
        }
    }
}