<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `region`.
 */
class m170726_203618_create_region_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('region', [
            'id'            => $this->primaryKey(),
            'name'      => $this->string(25),
            'description'     => $this->text(),
            'status'        => $this->boolean(),
            'created_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP',
            'updated_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        // creates index for table `region`
        $this->createIndex(
            'idx-region',
            'region',
            ['id' , 'name', 'status', 'created_at', 'updated_at']
        );


        $this->insert('region', [
            'id'            =>  1,
            'name'      =>  'Greater Accra',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('region', [
            'id'            =>  2,
            'name'      =>  'Ashanti',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('region', [
            'id'            =>  3,
            'name'      =>  'Eastern',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('region', [
            'id'            =>  4,
            'name'      =>  'Western',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('region', [
            'id'            =>  5,
            'name'      =>  'Nothern',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('region', [
            'id'            =>  6,
            'name'      =>  'Volta',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('region', [
            'id'            =>  7,
            'name'      =>  'Upper West',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('region', [
            'id'            =>  8,
            'name'      =>  'Upper East',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('region', [
            'id'            =>  9,
            'name'      =>  'Central',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('region', [
            'id'            =>  10,
            'name'      =>  'Brong Ahafo',
            'status'        =>  1,
            'description'     =>  '',
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('idx-region', 'region');
        $this->dropTable('region');
    }
}
