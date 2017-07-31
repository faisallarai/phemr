<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `gender`.
 */
class m170726_203515_create_gender_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('gender', [
            'id'            => $this->primaryKey(),
            'name'      => $this->string(25),
            'description'     => $this->text(),
            'status'        => $this->boolean(),
            'created_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP',
            'updated_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        // creates index for table `gender`
        $this->createIndex(
            'idx-gender',
            'gender',
            ['id' , 'name', 'status', 'created_at', 'updated_at']
        );


        $this->insert('gender', [
            'id'            =>  1,
            'name'      =>  'Male',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('gender', [
            'id'            =>  2,
            'name'      =>  'Female',
            'status'        =>  1,
            'description'     =>  '',
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('idx-gender', 'gender');
        $this->dropTable('gender');
    }
}
