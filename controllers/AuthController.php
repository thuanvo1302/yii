<?php

namespace app\controllers;

use app\services\AuthService;
use Yii;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;
use yii\web\UnauthorizedHttpException;

class AuthController extends BaseController
{
    /**
     * @throws NotInstantiableException
     * @throws InvalidConfigException|UnauthorizedHttpException
     */
    public function actionLogin(): array
    {
        $params = Yii::$app->request->getBodyParams();
        $authService = Yii::$container->get(AuthService::class);
        $authInfo = $authService->login($params);
        if ($authInfo == null) {
            return [];
        }
        return $authInfo;
    }
}
