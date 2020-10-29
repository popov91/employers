<?php

namespace app\controllers;

use app\models\Department;
use app\models\forms\DepartmentEditForm;
use app\models\forms\DepartmentForm;
use app\services\DepartmentCalculatorService;
use app\services\DepartmentService;
use Yii;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;

class DepartmentController extends \yii\web\Controller
{
    private $departmentService;
    private $departmentCalculatorService;

    public function __construct(
        $id,
        $module,
        DepartmentService $departmentService,
        DepartmentCalculatorService
        $departmentCalculatorService,
        $config = [])
    {
        $this->departmentService = $departmentService;
        $this->departmentCalculatorService = $departmentCalculatorService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'departments' => $this->departmentService->findAll(),
            'calculator' => $this->departmentCalculatorService,
        ]);
    }

    public function actionCreate()
    {
        $model = new DepartmentForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->departmentService->create($model->name);

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $department = $this->findModel($id);
        $form = new DepartmentEditForm($department);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->departmentService->edit($department->id, $form->name);
            Yii::$app->session->setFlash('success', 'Запись успешно изменена.');

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'editForm' => $form,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $department = $this->findModel($id);
        if ($this->departmentService->delete($department->id)) {
            Yii::$app->session->setFlash('success', 'Запись успешно удалена!');
        } else {
            Yii::$app->session->setFlash('error', 'Невозможно удалить отдел с сотрудниками');
        }
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Department::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Страница не существует.');
        }
    }
}
