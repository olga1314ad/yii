<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apples}}`.
 */
class m231020_205912_create_apples_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apples}}', [
            'id' => $this->primaryKey(),
            'color_id' => $this->integer()->notNull(),
            'created_at' => $this->time()->notNull(),
            'fallen_at' => $this->time(),
            'status' => $this->boolean()->notNull()->defaultValue(0),
            'eaten' => $this->integer()->defaultValue(0),
            'condition' => $this->integer(1)->defaultValue(0),
            'deleted_at' => $this->time()
        ]);

        $this->createIndex(
            'idx-apples-color_id',
            'apples',
            'color_id'
        );

        $this->addForeignKey(
            'fk-apples-color_id',
            'apples',
            'color_id',
            'colors',
            'color_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apples}}');

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-apples-color_id',
            'apples'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-apples-color_id',
            'apples'
        );
    }
}
