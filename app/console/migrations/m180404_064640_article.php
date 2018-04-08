<?php

use yii\db\Migration;

/**
 * Class m180404_064640_article
 */
class m180404_064640_article extends Migration
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

        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'uid' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'content' =>$this->text()->notNull(),
            'created_time' =>$this->integer(),
            'updated_time' =>$this->integer(),

        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180404_064640_article cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180404_064640_article cannot be reverted.\n";

        return false;
    }
    */
}
