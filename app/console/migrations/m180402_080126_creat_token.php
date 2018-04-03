<?php

use yii\db\Migration;

/**
 * Class m180402_080126_creat_token
 */
class m180402_080126_creat_token extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_token}}', [
            'id' => $this->primaryKey(),
            'uid' => $this->string()->notNull()->unique(),
            'token' => $this->string()->notNull(),
            'expired' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180402_080126_creat_token cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180402_080126_creat_token cannot be reverted.\n";

        return false;
    }
    */
}
