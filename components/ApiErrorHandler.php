<?php

namespace app\components;

use Yii;
use yii\web\ErrorHandler;
use yii\web\Response;

class ApiErrorHandler extends ErrorHandler
{
    protected function renderException($exception): void
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        Yii::$app->response->statusCode = $exception->statusCode ?? 500;

        Yii::$app->response->data = [
            'success' => false,
            'message' => YII_DEBUG
                ? $exception->getMessage()
                : 'Internal Server Error',
        ];

        Yii::$app->response->send();
    }
}
