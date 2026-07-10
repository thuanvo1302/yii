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
        $params = Yii::$app->request->getBodyParams();
        $authService = Yii::$container->get(AuthService::class);
        return [
            $authService->login($params),
        ];
    }
}
