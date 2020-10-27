<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employers_lnk_departments}}`.
 */
class m201027_194010_create_employers_lnk_departments_table extends Migration
{
    const TABLE_NAME = 'employers_lnk_departments';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'employer_id'   => 'INT NOT NULL',
            'department_id' => 'INT NOT NULL',
        ]);

        $this->addPrimaryKey('pk-' . static::TABLE_NAME, static::TABLE_NAME, ['employer_id', 'department_id']);

        $this->addForeignKey('fk-' . static::TABLE_NAME . '[employer]',
            static::TABLE_NAME,
            'employer_id',
            'employers',
            'id',
            'restrict',
            'restrict')
        ;

        $this->addForeignKey('fk-' . static::TABLE_NAME . '[department]',
            static::TABLE_NAME,
            'department_id',
            'departments',
            'id',
            'restrict',
            'restrict')
        ;

        $this->addCommentOnTable(static::TABLE_NAME, 'Таблица связей сотрудников с отделами');
        $this->addCommentOnColumn(static::TABLE_NAME, 'employer_id', 'Идентификатор сотрудника');
        $this->addCommentOnColumn(static::TABLE_NAME, 'department_id', 'Идентификатор отдела');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-' . static::TABLE_NAME . '[employer]', static::TABLE_NAME);
        $this->dropForeignKey('fk-' . static::TABLE_NAME . '[department]', static::TABLE_NAME);

        $this->dropTable(self::TABLE_NAME);
    }
}
