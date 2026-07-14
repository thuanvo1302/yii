<?php

namespace app\services;

use app\models\Users;
use app\repositories\UserRepository;
use Firebase\JWT\JWT;
use Throwable;
use Yii;
use yii\web\UnauthorizedHttpException;

class AuthService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function login(array $params): array
    {
        try {
            $user = $this->userRepository->findByUserName($params);
            if ($user == null) {
                return [];
            }
            $token = $this->generateAccessToken($user);

            return [
                'user' => $user,
                'token' => $token,
            ];
        } catch (Throwable $e) {
            throw new UnauthorizedHttpException($e->getMessage());
        }
    }

    public function generateAccessToken(Users $user = null): string
    {
        $jwt = Yii::$app->params['jwt'];
        $jwt_ttl = Yii::$app->params['ttl'];

        $currentTime = time();
        $expireTime = $currentTime + $jwt_ttl;

        $payload = [
            'iat' => $currentTime,
            'nbf' => $currentTime,
            'exp' => $expireTime,
            'data' => [
                'id' => $user->id,
                'email' => $user->username,
            ]
        ];

        return JWT::encode($payload, $jwt, 'HS256');
    }
}
