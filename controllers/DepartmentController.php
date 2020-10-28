<?php

namespace app\controllers;

use app\services\DepartmentCalculatorService;
use app\services\DepartmentService;

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
}
