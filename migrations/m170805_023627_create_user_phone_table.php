<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_phone`.
 * Has foreign keys to the tables:
 *
 * - `phone`
 * - `user`
 */
class m170805_023627_create_user_phone_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('user_phone', [
            'id' => $this->primaryKey(),
            'phoneid' => $this->integer(),
            'userid' => $this->integer(),
        ],$tableOptions);

        // creates index for column `phoneid`
        $this->createIndex(
            'idx-user_phone-phoneid',
            'user_phone',
            'phoneid'
        );

        // add foreign key for table `phone`
        $this->addForeignKey(
            'fk-user_phone-phoneid',
            'user_phone',
            'phoneid',
            'phone',
            'id',
            'CASCADE'
        );

        // creates index for column `userid`
        $this->createIndex(
            'idx-user_phone-userid',
            'user_phone',
            'userid'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_phone-userid',
            'user_phone',
            'userid',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `phone`
        $this->dropForeignKey(
            'fk-user_phone-phoneid',
            'user_phone'
        );

        // drops index for column `phoneid`
        $this->dropIndex(
            'idx-user_phone-phoneid',
            'user_phone'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user_phone-userid',
            'user_phone'
        );

        // drops index for column `userid`
        $this->dropIndex(
            'idx-user_phone-userid',
            'user_phone'
        );

        $this->dropTable('user_phone');
    }
}
