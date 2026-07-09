<?php

namespace app\controllers;

use app\services\AuthService;
use Yii;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;
use yii\rest\Controller;

class AuthController extends Controller
{
    /**
     * @throws NotInstantiableException
     * @throws InvalidConfigException
     */
    public function actionLogin(): array
    {
        $body = Yii::$app->request->bodyParams;
        $authService = Yii::$container->get(AuthService::class);
        return [
            $authService->login($body['username'], $body['password']),
        ];
    }
}
