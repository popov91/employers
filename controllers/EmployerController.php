<?php

namespace app\controllers;

use app\models\Employer;
use app\models\forms\EmployerEditForm;
use app\models\forms\EmployerForm;
use app\services\DepartmentService;
use app\services\EmployerService;
use app\services\structures\EmployerData;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class EmployerController extends Controller
{
    private $employerService;
    private $departmentService;

    public function __construct(
        $id,
        $module,
        EmployerService $employerService,
        DepartmentService $departmentService,
        $config = [])
    {
        $this->departmentService = $departmentService;
        $this->employerService = $employerService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->render('index',[
            'employers' => $this->employerService->findAll(),
        ]);
    }

    public function actionCreate()
    {
        $model = new EmployerForm;
        $departments = $this->departmentService->findAll();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->employerService->create(
                new EmployerData(
                    $model->name,
                    $model->surname,
                    $model->patronymic,
                    $model->gender,
                    $model->salary,
                ), $model->departments);
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'departments' => $departments,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $employer = $this->findModel($id);
        $form = new EmployerEditForm($employer);
        $departments = $this->departmentService->findAll();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->employerService->edit(
                $employer->id,
                new EmployerData(
                    $form->name,
                    $form->surname,
                    $form->patronymic,
                    $form->gender,
                    $form->salary,
                ), $form->departments);
            Yii::$app->session->setFlash('success', 'Запись успешно изменена.');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'editForm' => $form,
                'departments' => $departments,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $employer = $this->findModel($id);
        if ($this->employerService->delete($employer->id)) {
            Yii::$app->session->setFlash('success', 'Запись успешно удалена!');
        } else {
            Yii::$app->session->setFlash('error', 'Невозможно удалить сотрудника с отделами');
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Employer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Страница не существует.');
        }
    }
}
