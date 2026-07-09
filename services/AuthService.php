<?php

namespace app\services;

use app\repositories\UserRepository;

class AuthService
{
    public function __construct(private UserRepository $userRepository)
    {

    }
    public function login(string $username, string $password)
    {
        $user = $this->userRepository->findByUserName($username);
        if ($user !== null) {
            // generate token
             return 'OK';
        }
    }

    public function generateAccessToken()
    {

    }
}
