<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `marital_status`.
 */
class m170726_203548_create_marital_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('marital_status', [
            'id'            => $this->primaryKey(),
            'name'      => $this->string(25),
            'description'     => $this->text(),
            'status'        => $this->boolean(),
            'created_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP',
            'updated_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        // creates index for table `title`
        $this->createIndex(
            'idx-marital_status',
            'marital_status',
            ['id' , 'name', 'status', 'created_at', 'updated_at']
        );


        $this->insert('marital_status', [
            'id'            =>  1,
            'name'      =>  'Mr.',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('marital_status', [
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
        $this->dropIndex('idx-marital_status', 'marital_status');
        $this->dropTable('marital_status');
    }
}
