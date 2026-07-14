<?php

namespace app\components\filters;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Throwable;
use Yii;
use yii\base\ActionFilter;
use yii\web\UnauthorizedHttpException;

class AuthFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        try {
            $authHeader = Yii::$app->request->headers->get('Authorization');

            if (!$authHeader || !preg_match('/^Bearer\s+(.*?)$/i', $authHeader, $matches)) {
                return false;
            }
            $token = $matches[1];
            $secret = Yii::$app->params['jwt'];
            $decoded = JWT::decode($token, new Key($secret, 'HS256'));
            Yii::$app->params['currentUser'] = $decoded->data;

            return true;

        } catch (Throwable $e) {
            throw new UnauthorizedHttpException($e->getMessage());
        }
    }
}
