<?php

use yii\db\Migration;

/**
 * Class m231020_220752_change_apples_table
 */
class m231020_220752_change_apples_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('apples', 'status', $this->integer(1)->defaultValue(0));
        $this->dropColumn('apples', 'condition');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('apples', 'status', $this->boolean()->notNull()->defaultValue(0));
        $this->addColumn('apples', 'condition', $this->integer(1)->defaultValue(0));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231020_220752_change_apples_table cannot be reverted.\n";

        return false;
    }
    */
}
