<?php

use yii\db\Migration;

/**
 * Handles the creation of table `phone`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m170805_022846_create_phone_table extends Migration
{
    /**
     * @inheritdoc 中继号码
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('phone', [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->unique()->comment('中继号码'),
            'type'=>$this->smallInteger(1)->notNull()->defaultValue(0)->comment('类型'),
            'status' => $this->smallInteger(1)->defaultValue(0)->notNull()->comment('状态'),
            'remark'=> $this->text()->comment('备注'),
        ],$tableOptions);

        // creates index for column `number`
        $this->createIndex(
            'idx-phone-number',
            'phone',
            'number'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops index for column `number`
        $this->dropIndex(
            'idx-phone-number',
            'phone'
        );
        $this->dropTable('phone');
    }
}
