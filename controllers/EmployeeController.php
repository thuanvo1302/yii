<?php

namespace app\controllers;

use app\services\EmployeeService;
use OpenApi\Attributes as OA;
use Yii;

class EmployeeController extends BaseController
{
    private EmployeeService $employeeService;

    public function init()
    {
        parent::init();
        $this->employeeService = Yii::$container->get(EmployeeService::class);
    }

    #[OA\Get(
        path: '/employee',
        summary: 'Lấy danh sách nhân viên',
        security: [['BearerAuth' => []]], // Yêu cầu token
        responses: [
            new OA\Response(response: 200, description: 'Thành công'),
            new OA\Response(response: 401, description: 'Token không hợp lệ')
        ]
    )]
    public function actionIndex()
    {
        return $this->employeeService->getAll();
    }

    #[OA\Get(
        path: '/employee/{id}',
        summary: 'Lấy nhân viên chi tiết',
        security: [['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Thành công'),
            new OA\Response(response: 401, description: 'Token không hợp lệ')
        ]
    )]
    public function actionView()
    {
        $params = Yii::$app->getRequest()->getQueryParams();
        return $this->employeeService->getDetail($params);
    }

    #[OA\Post(
        path: '/employee',
        summary: 'Tạo mới một nhân viên',
        security: [['BearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['fullname', 'email'],
                properties: [
                    new OA\Property(property: 'fullname', type: 'string', example: 'Nguyen Van A'),
                    new OA\Property(property: 'age', type: 'integer', example: 23),
                    new OA\Property(property: 'gender', type: 'string', example: 'Male'),
                    new OA\Property(property: 'phone', type: 'string', example: '03821843451'),
                    new OA\Property(property: 'email', type: 'string', example: 'admin@gmail.com')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Tạo thành công'),
            new OA\Response(response: 400, description: 'Dữ liệu lỗi')
        ]
    )]
    public function actionCreate()
    {
        $params = Yii::$app->request->getBodyParams();
        return $this->employeeService->create($params);
    }

    #[OA\Put(
        path: '/employee/{id}',
        summary: 'Cập nhật nhân viên',
        security: [['BearerAuth' => []]],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'fullname', type: 'string', example: 'Nguyen Van A'),
                    new OA\Property(property: 'age', type: 'integer', example: 23),
                    new OA\Property(property: 'gender', type: 'string', example: 'Male'),
                    new OA\Property(property: 'phone', type: 'string', example: '03821843451'),
                    new OA\Property(property: 'email', type: 'string', example: 'admin@gmail.com')
                ]
            )
        ),
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Cập nhật thành công')
        ]
    )]
    public function actionUpdate()
    {
        $queryParams = Yii::$app->request->getQueryParams();
        $params = Yii::$app->request->getBodyParams();
        $id = $queryParams['id'];

        return $this->employeeService->update($params, $id);
    }

    #[OA\Delete(
        path: '/employee/{id}',
        summary: 'Xóa nhân viên',
        security: [['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Cập nhật thành công')
        ]
    )]
    public function actionDelete()
    {
        $queryParams = Yii::$app->request->getQueryParams();
        $id = $queryParams['id'];

        return $this->employeeService->delete($id);
    }
}
