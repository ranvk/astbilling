<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service`.
 */
class m170805_025554_create_service_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('service', [
            'id' => $this->primaryKey(),
            'host' => $this->string()->comment('ip'),
            'port' => $this->integer(5)->comment('socket端口'),
            'trunk' => $this->integer(2)->comment('中继数量'),
            'status' => $this->smallInteger(1)->defaultValue(0)->notNull()->comment('状态'),
            'remark' => $this->text()->comment('备注'),
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('service');
    }
}
