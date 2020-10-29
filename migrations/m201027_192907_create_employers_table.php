<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employers}}`.
 */
class m201027_192907_create_employers_table extends Migration
{
    const TABLE_NAME = 'employers';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull(),
            'surname' => $this->string(30)->notNull(),
            'patronymic' => $this->string(30),
            'gender' => $this->smallInteger(2),
            'salary' => $this->integer()->notNull(),
        ]);

        $this->createIndex('ix-' . static::TABLE_NAME . '[id]', static::TABLE_NAME, 'id');

        $this->addCommentOnTable(static::TABLE_NAME, 'Таблица сотрудников');
        $this->addCommentOnColumn(static::TABLE_NAME, 'id', 'Идентификатор');
        $this->addCommentOnColumn(static::TABLE_NAME, 'name', 'Имя');
        $this->addCommentOnColumn(static::TABLE_NAME, 'surname', 'Фамилия');
        $this->addCommentOnColumn(static::TABLE_NAME, 'patronymic', 'Отчество');
        $this->addCommentOnColumn(static::TABLE_NAME, 'gender', 'Пол');
        $this->addCommentOnColumn(static::TABLE_NAME, 'salary', 'Зарплата');
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
