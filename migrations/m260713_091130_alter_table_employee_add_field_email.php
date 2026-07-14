<?php

use yii\db\Migration;

class m260713_091130_alter_table_employee_add_field_email extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%employees}}', 'email', $this->string(255)->after('name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%employees}}', 'email');
    }
}
