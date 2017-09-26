<?php

use yii\db\Migration;

/**
 * Handles the creation of table `whitelist`.
 */
class m170805_025108_create_whitelist_table extends Migration
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

        $this->createTable('whitelist', [
            'id' => $this->primaryKey(),
            'prefixnum' => $this->integer()->comment('呼入前缀'),
            'provider' => $this->smallInteger(1)->notNull()->defaultValue(0)->comment('供应商'),
            'status' => $this->smallInteger(1)->defaultValue(0)->notNull()->comment('状态'),
            'remark'=> $this->text()->comment('备注'),
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('whitelist');
    }
}
