<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `insurance_provider_category`.
 */
class m170726_203618_create_insurance_provider_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('insurance_provider_category', [
            'id'            => $this->primaryKey(),
            'name'      => $this->string(25),
            'description'     => $this->text(),
            'status'        => $this->boolean(),
            'created_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP',
            'updated_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        // creates index for table `insurance_provider_category`
        $this->createIndex(
            'idx-insurance_provider_category',
            'insurance_provider_category',
            ['id' , 'name', 'status', 'created_at', 'updated_at']
        );


        $this->insert('insurance_provider_category', [
            'id'            =>  1,
            'name'      =>  'Public',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('insurance_provider_category', [
            'id'            =>  2,
            'name'      =>  'Private',
            'status'        =>  1,
            'description'     =>  '',
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('idx-insurance_provider_category', 'insurance_provider_category');
        $this->dropTable('insurance_provider_category');
    }
}
