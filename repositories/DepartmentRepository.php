<?php

namespace app\repositories;

use app\models\Department;
use app\repositories\exceptions\NotFoundException;
use Yii;
use yii\db\Exception;

class DepartmentRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = Yii::$app->getDb();
    }

    public function find(string $id): Department
    {
        if (!$department = Department::findOne($id)) {
            throw new NotFoundException('Запись не найдена.');
        }

        return $department;
    }

    public function findAll(): array
    {
        return Department::find()->all();
    }

    public function add(Department $department): void
    {
        if (!$department->getIsNewRecord()) {
            throw new \RuntimeException('Запись уже существует.');
        }
        if (!$department->insert(false)) {
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }

    public function save(Department $department): void
    {
        if ($department->getIsNewRecord()) {
            throw new \RuntimeException('Невозможно сохранить новую запись.');
        }
        if ($department->update(false) === false) {
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }

    public function delete(Department $department): void
    {
        if (!$department->delete()) {
            throw new \RuntimeException('Ошибка удаления.');
        }
    }

    public function countEmployersById(string $id): ?int
    {
        $sql = "SELECT COUNT(*) FROM employers_lnk_departments WHERE department_id = :id";

        try {
            $employers = $this->connection
                ->createCommand($sql)
                ->bindValue(':id', $id)
                ->queryScalar();
        } catch (Exception $e) {
            throw new \RuntimeException('Ошибка при выполнении запроса.');
        }

        return $employers;
    }

    public function getMaxSalaryById(string $id): ?int
    {
        $sql = "SELECT MAX(salary) FROM employers
                WHERE employers.id IN (SELECT employer_id 
                FROM employers_lnk_departments WHERE department_id = :id)";
        try {
            $salary = $this->connection
                ->createCommand($sql)
                ->bindValue(':id', $id)
                ->queryScalar();
        } catch (Exception $e) {
            throw new \RuntimeException('Ошибка при выполнении запроса.');
        }

        return $salary;
    }
}