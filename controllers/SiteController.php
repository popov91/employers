<?php

namespace app\controllers;

use app\models\EmployersLnkDepartments;
use app\services\DepartmentService;
use app\services\EmployerService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class SiteController extends Controller
{

    private $departmentService;
    private $employerService;

    public function __construct(
        $id,
        $module,
        DepartmentService $departmentService,
        EmployerService $employerService,
        $config = [])
    {
        $this->departmentService = $departmentService;
        $this->employerService = $employerService;
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $relations = EmployersLnkDepartments::getRelations();
        return $this->render('index', [
            'departments' => $this->departmentService->findAll(),
            'employers' => $this->employerService->findAll(),
            'relations' => $relations,
        ]);
    }
}
