<?php

use yii\db\Migration;

/**
 * Class m231021_071854_change_apples_table2
 */
class m231021_071854_change_apples_table2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('apples', 'created_at', $this->integer()->notNull());
        $this->alterColumn('apples', 'deleted_at', $this->integer());
        $this->alterColumn('apples', 'fallen_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('apples', 'created_at', $this->time()->notNull());
        $this->alterColumn('apples', 'deleted_at', $this->time());
        $this->alterColumn('apples', 'fallen_at', $this->time());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231021_071854_change_apples_table2 cannot be reverted.\n";

        return false;
    }
    */
}
