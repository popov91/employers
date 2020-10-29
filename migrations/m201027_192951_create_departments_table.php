<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%departments}}`.
 */
class m201027_192951_create_departments_table extends Migration
{
    const TABLE_NAME = 'departments';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable( self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull(),
        ]);

        $this->createIndex('ix-' . static::TABLE_NAME . '[id]', static::TABLE_NAME, 'id');

        $this->addCommentOnTable(static::TABLE_NAME, 'Таблица отделов');
        $this->addCommentOnColumn(static::TABLE_NAME, 'id', 'Идентификатор');
        $this->addCommentOnColumn(static::TABLE_NAME, 'name', 'Наименование отдела');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-' . static::TABLE_NAME . '[id]', static::TABLE_NAME);

        $this->dropTable(self::TABLE_NAME);
    }
}
