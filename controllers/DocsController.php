<?php

namespace app\controllers;

use yii\rest\Controller;
use OpenApi\Generator;
use Yii;
use yii\web\Response;

class DocsController extends Controller
{
    public function actionJson()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $generator = new Generator();
        $openapi = $generator->generate([Yii::getAlias('@app/controllers')]);

        return json_decode($openapi->toJson());
    }

    public function actionIndex()
    {
        $this->layout = false;

        Yii::$app->response->format = Response::FORMAT_HTML;

        return '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>API Documentation</title>
            <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@5/swagger-ui.css" />
        </head>
        <body>
            <div id="swagger-ui"></div>
            <script src="https://unpkg.com/swagger-ui-dist@5/swagger-ui-bundle.js"></script>
            <script>
                window.onload = () => {
                    window.ui = SwaggerUIBundle({
                        url: "/docs/json",
                        dom_id: "#swagger-ui",
                    });
                };
            </script>
        </body>
        </html>
        ';
    }
}
