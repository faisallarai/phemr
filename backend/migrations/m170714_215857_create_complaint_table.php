<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `complaint`.
 */
class m170714_215857_create_complaint_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('complaint', [
            'id'            => $this->primaryKey(),
            'title'      => $this->string(255),
            'description'     => $this->text(),
            'status'        => $this->boolean(),
            'created_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP',
            'updated_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        // creates index for table `complaint`
        $this->createIndex(
            'idx-complaint',
            'complaint',
            ['title' , 'status', 'created_at', 'updated_at']
        );


        $this->insert('complaint', [
            'id'            =>  1,
            'title'      =>  'Roof Leaking',
            'status'        =>  1,
            'description'     =>  'Since i entered the apartment, it has been leaking, please do something as soon as possible',
        ]);

        $this->insert('complaint', [
            'id'            =>  2,
            'title'      =>  'Loud Noise',
            'status'        =>  1,
            'description'     =>  'There is always loud noise coming from my neighbour during the night, please talk to him',
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('idx-complaint', 'complaint');
        $this->dropTable('complaint');
    }
}
