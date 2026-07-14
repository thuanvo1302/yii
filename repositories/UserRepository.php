<?php

namespace app\repositories;

use app\models\Users;
use Throwable;
use Yii;

class UserRepository
{
    public function findByUserName(array $params): ?Users
    {
        return Users::find()
            ->where(['username' => $params['username']])
            ->andWhere(['password_hash' => $params['password']])
            ->one();
    }
}
