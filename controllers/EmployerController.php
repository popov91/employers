<?php

namespace app\controllers;

use app\services\EmployerService;

class EmployerController extends \yii\web\Controller
{
    private $employerService;

    public function __construct($id, $module, EmployerService $employerService, $config = [])
    {
        $this->employerService = $employerService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->render('index',[
            'employers' => $this->employerService->findAll(),
        ]);
    }
}
