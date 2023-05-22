<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m230522_151546_create_order_table extends Migration
{
    private const TABLE_NAME = '{{%order}}';
    
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ИД'),
            'created_at' => $this->date()->notNull()->comment('Дата создания'),
            'name' => $this->string(128)->notNull()->comment('Название'),
            'status_id' => $this->integer()->notNull()->comment('ИД статуса'),
        ]);
        
        $this->alterColumn(self::TABLE_NAME, 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
