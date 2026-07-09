<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public int $id;
    public string $username = '';
    public string $passwordHash = '';

}
