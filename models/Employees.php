<?php

namespace app\models;

use yii\db\ActiveRecord;

class Employees extends ActiveRecord
{
    public static function tableName()
    {
        return '{{employees}}';
    }

    public function rules()
    {
        return [
            [['fullname','gender','age','phone'], 'required'],
            [['email'], 'email'],
        ];
    }
}
