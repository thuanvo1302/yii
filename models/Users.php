<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class Users extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%users}}';
    }

    public function rules():array
    {
        return [
            [['username'], 'required', 'unique', 'string', 'max' => 255],
        ];
    }

    public function fields(): array
    {
        $fields = parent::fields();
        unset($fields['password_hash']);
        return $fields;
    }
}
