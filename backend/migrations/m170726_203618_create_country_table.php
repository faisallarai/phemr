<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `country`.
 */
class m170726_203618_create_country_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('country', [
            'id'            => $this->primaryKey(),
            'name'      => $this->string(25),
            'description'     => $this->text(),
            'status'        => $this->boolean(),
            'created_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP',
            'updated_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        // creates index for table `country`
        $this->createIndex(
            'idx-country',
            'country',
            ['id' , 'name', 'status', 'created_at', 'updated_at']
        );


        $this->insert('country', [
            'id'            =>  1,
            'name'      =>  'Ghana',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('country', [
            'id'            =>  2,
            'name'      =>  'Togo',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('country', [
            'id'            =>  3,
            'name'      =>  'Nigeria',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('country', [
            'id'            =>  4,
            'name'      =>  'Cote Divoire',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('country', [
            'id'            =>  5,
            'name'      =>  'Burkina Faso',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('country', [
            'id'            =>  6,
            'name'      =>  'Liberia',
            'status'        =>  1,
            'description'     =>  '',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('idx-country', 'country');
        $this->dropTable('country');
    }
}
