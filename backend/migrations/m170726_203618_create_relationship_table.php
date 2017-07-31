<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `relationship`.
 */
class m170726_203618_create_relationship_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('relationship', [
            'id'            => $this->primaryKey(),
            'name'      => $this->string(25),
            'description'     => $this->text(),
            'status'        => $this->boolean(),
            'created_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP',
            'updated_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        // creates index for table `relationship`
        $this->createIndex(
            'idx-relationship',
            'relationship',
            ['id' , 'name', 'status', 'created_at', 'updated_at']
        );


        $this->insert('relationship', [
            'id'            =>  1,
            'name'      =>  'Self',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('relationship', [
            'id'            =>  2,
            'name'      =>  'Spouse',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('relationship', [
            'id'            =>  3,
            'name'      =>  'Child',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('relationship', [
            'id'            =>  4,
            'name'      =>  'Other',
            'status'        =>  1,
            'description'     =>  '',
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('idx-relationship', 'relationship');
        $this->dropTable('relationship');
    }
}
