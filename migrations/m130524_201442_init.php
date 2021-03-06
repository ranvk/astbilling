<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'type' => $this->string()->comment('用户类型'),
            'float' => $this->string()->comment('计时浮动'),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);


        $this->batchInsert('{{%user}}', [
            'id', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'type', 'float', 'status', 'created_at', 'updated_at'
        ], [[
            1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '', '', '1', '1.5', 1, 0, 0
        ]]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
