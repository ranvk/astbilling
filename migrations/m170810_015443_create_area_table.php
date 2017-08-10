<?php

use yii\db\Migration;

/**
 * Handles the creation of table `area`.
 */
class m170810_015443_create_area_table extends Migration
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
        $this->createTable('area', [
            'number' => $this->integer()->notNull()->unsigned(),
            'area' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'area_code' => $this->string()->notNull(),
            'postcode' => $this->string()->notNull(),

        ],$tableOptions);

        // creates index for column `number`
        $this->createIndex(
            'idx-area-number',
            'area',
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
            'idx-area-number',
            'area'
        );


        $this->dropTable('area');
    }
}
