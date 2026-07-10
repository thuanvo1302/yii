<?php

namespace app\controllers;

use app\models\Employees;
use app\services\EmployeeService;
use Yii;
use yii\rest\Controller;

class EmployeeController extends Controller
{
    private EmployeeService  $employeeService;

    public function init()
    {
        parent::init();
        $this->employeeService = Yii::$container->get(EmployeeService::class);
    }

    public function actionIndex()
    {
        return $this->employeeService->getAll();
    }

    public function actionView()
    {
        $params = Yii::$app->getRequest()->getQueryParams();
        return $this->employeeService->getDetail($params);
    }

    public function actionCreate()
    {
        $params = Yii::$app->request->getBodyParams();
        return $this->employeeService->create($params);
    }

    public function actionUpdate()
    {
        $queryParams = Yii::$app->request->getQueryParams();
        $params = Yii::$app->request->getBodyParams();
        $id = $queryParams['id'];

        return $this->employeeService->update($params, $id);
    }

    public function actionDelete()
    {
        $queryParams = Yii::$app->request->getQueryParams();
        $id = $queryParams['id'];

        return $this->employeeService->delete($id);
    }
}
