<?php

namespace app\services;

use app\models\Users;
use app\repositories\UserRepository;

class AuthService
{
    public function __construct(private UserRepository $userRepository)
    {

    }
    public function login(array $params): Users|null
    {
        $user = $this->userRepository->findByUserName($params);
        return $user ?? null;
    }

    public function generateAccessToken()
    {

    }
}
