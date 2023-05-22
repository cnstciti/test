<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status}}`.
 */
class m230522_153105_create_status_table extends Migration
{
    private const TABLE_NAME = '{{%status}}';
    
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ИД'),
            'name' => $this->string(128)->notNull()->comment('Статус'),
        ]);
        
        $this->alterColumn(self::TABLE_NAME, 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');
        
        $this->batchInsert(self::TABLE_NAME, ['id', 'name'], [
            [1, 'В работе'],
            [2, 'Выполнен'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete(self::TABLE_NAME, ['id' => 1]);
        $this->delete(self::TABLE_NAME, ['id' => 2]);
        $this->dropTable(self::TABLE_NAME);
    }
}
