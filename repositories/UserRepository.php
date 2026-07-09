<?php

namespace app\repositories;

use app\models\User;

class UserRepository
{
    public function findByUserName(string $username): User|string
    {
        return 'OK';
//        return User::find()
//            ->where(['username' => $username])
//            ->one();
    }
}
