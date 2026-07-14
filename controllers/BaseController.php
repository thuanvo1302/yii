<?php

namespace app\controllers;

use yii\rest\Controller;
use app\components\filters\AuthFilter;
use OpenApi\Attributes as OA;

#[OA\OpenApi(openapi: '3.2.0')]
#[OA\Info(version: '2.0.0', title: 'Employee CRUD API')]
#[OA\Server(url: 'http://localhost:8080', description: 'Local API Server')]
#[OA\SecurityScheme(
    securityScheme: 'BearerAuth',
    type: 'http',
    name: 'Authorization',
    in: 'header',
    bearerFormat: 'JWT',
    scheme: 'bearer'
)]

class BaseController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => AuthFilter::class,
            'except' => ['login']
        ];

        return $behaviors;
    }
}
