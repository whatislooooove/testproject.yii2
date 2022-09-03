<?php

use yii\db\Migration;

/**
 * Class m220903_104842_apples
 */
class m220903_104842_apples extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220903_104842_apples cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%apples}}', [
            'id' => $this->primaryKey(),
            'apple_number' => $this->tinyInteger()->notNull(),
            'color' => $this->string()->notNull(),
            'eaten' => $this->string(100)->notNull(),
            'is_fresh' => $this->tinyInteger(1)->notNull(),
            'on_the_tree' => $this->tinyInteger(1)->notNull(),

            'created_at' => $this->integer()->notNull(),
            'falled_at' => $this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        echo "m220903_104842_apples cannot be reverted.\n";

        return false;
    }

}
