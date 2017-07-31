<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `title`.
 */
class m170726_203530_create_title_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('title', [
            'id'            => $this->primaryKey(),
            'name'      => $this->string(25),
            'description'     => $this->text(),
            'status'        => $this->boolean(),
            'created_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP',
            'updated_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        // creates index for table `title`
        $this->createIndex(
            'idx-title',
            'title',
            ['id' , 'name', 'status', 'created_at', 'updated_at']
        );


        $this->insert('title', [
            'id'            =>  1,
            'name'      =>  'Mr.',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('title', [
            'id'            =>  2,
            'name'      =>  'Mrs.',
            'status'        =>  1,
            'description'     =>  '',
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('idx-title', 'title');
        $this->dropTable('title');
    }
}
