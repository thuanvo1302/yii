<?php

namespace app\components;

use yii\web\Response as BaseResponse;

class ApiResponse extends BaseResponse
{
    public function init()
    {
        parent::init();

        $this->format = self::FORMAT_JSON;
        $this->charset = 'UTF-8';

        $this->on(self::EVENT_BEFORE_SEND, [$this, 'handleBeforeSend']);
    }

    public function handleBeforeSend($event)
    {
        $response = $event->sender;

        if ($response->format !== self::FORMAT_JSON) {
            return;
        }
        if ($response->data !== null) {
            if (
                (is_array($response->data) && isset($response->data['openapi'])) ||
                (is_object($response->data) && isset($response->data->openapi))
            ) {
                return;
            }

//            $isSuccess = $response->data == null || $response->data == [] ? $response->isSuccessful == false : $response->isSuccessful == true;
            $isSuccess = $response->isSuccessful;
            $originalData = $response->data;

            $status = $isSuccess ? 'OK' : 'ERROR';
            $message = $isSuccess ? 'Success' : 'An error occurred';
            $error = null;
            $data = $originalData;

            if ($isSuccess) {
                if (is_array($originalData)) {
                    if (isset($originalData['message'])) {
                        $message = $originalData['message'];
                        unset($originalData['message']);
                    }
                    if (isset($originalData['status'])) {
                        $status = $originalData['status'];
                        unset($originalData['status']);
                    }
                    if (isset($originalData['data'])) {
                        $data = $originalData['data'];
                    } else {
                        $data = $originalData;
                    }
                }
            } else {
                $status = 'ERROR';
                $error = $originalData;
                $message = isset($originalData['message']) ? $originalData['message'] : 'An error occurred';
                $data = null;
            }

            $response->data = [
                'status' => $status,
                'message' => $message,
                'error' => $error,
                'data' => $data,
            ];
        }
    }
}
