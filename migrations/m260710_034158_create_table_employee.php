<?php

use yii\db\Migration;

class m260710_034158_create_table_employee extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('employees', [
            'id' => $this->primaryKey(),
            'fullname' => $this->string()->notNull(),
            'age'       => $this->integer()->notNull(),
            'gender'    => $this->string()->notNull(),
            'phone'     => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employees}}');
    }
}
