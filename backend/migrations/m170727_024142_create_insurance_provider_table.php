<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `insurance_provider`.
 */
class m170727_024142_create_insurance_provider_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('insurance_provider', [
            'id'            => $this->primaryKey(),
            'name'      => $this->string(100)->notNull(),
            'address_1'      => $this->string(25)->notNull(),
            'address_2'      => $this->string(25),
            'phone'     => $this->string(15)->notNull(),
            'city'     => $this->string(25)->notNull(),
            'region_id'     => $this->integer()->notNull(),
            'country_id'     => $this->integer()->notNull(),
            'description'     => $this->text(),
            'insurance_provider_type_id'     => $this->integer()->notNull(),
            'insurance_provider_category_id'     => $this->integer()->notNull(),
            'user_id'     => $this->integer()->notNull(),
            'status'        => $this->boolean(),
            'created_by' => $this->integer()->notNull(), 
            'updated_by' => $this->integer()->notNull(),   
            'created_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP',
            'updated_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        // creates index for table `insurance_provider`
        $this->createIndex(
            'idx-insurance_provider',
            'insurance_provider',
            ['id' , 'name', 'status', 'created_at', 'updated_at']
        );

        // add foreign key for table `user`

        $this->addForeignKey(
            'fk-insurance_provider-user_id',
            'insurance_provider',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // add foreign key for table `insurance_provider_type`

        $this->addForeignKey(
            'fk-insurance_provider-insurance_provider_type_id',
            'insurance_provider',
            'insurance_provider_type_id',
            'insurance_provider_type',
            'id',
            'CASCADE'
        );

        // add foreign key for table `insurance_provider_category`

        $this->addForeignKey(
            'fk-insurance_provider-insurance_provider_category_id',
            'insurance_provider',
            'insurance_provider_category_id',
            'insurance_provider_category',
            'id',
            'CASCADE'
        );


        $this->insert('insurance_provider', [
            'id'            =>  1,
            'name'      =>  'NHIS',
            'address_1'      =>  'Accra main road',
            'address_2'      =>  '',
            'phone'      =>  '0209234567',
            'city'      =>  'Accra',
            'insurance_provider_type_id'      =>  1,
            'insurance_provider_category_id'      =>  1,
            'region_id'      =>  1,
            'country_id'      =>  1,
            'description'     =>  'National Health Insurance Sheme',
            'user_id'        =>  1,
            'status'        =>  1,
            'created_by'      =>  1,
            'updated_by'      =>  1,
            'created_at'        =>  '2017-07-26',
            'updated_at'        =>  '2017-07-26',
        ]);

        $this->insert('insurance_provider', [
            'id'            =>  2,
            'name'      =>  'Acacia',
            'address_1'      =>  'Accra main road',
            'address_2'      =>  '',
            'phone'      =>  '0209234567',
            'city'      =>  'Accra',
            'insurance_provider_type_id'      =>  1,
            'insurance_provider_category_id'      =>  1,
            'region_id'      =>  1,
            'country_id'      =>  1,
            'description'     =>  'Acasia health insurance scheme',
            'user_id'        =>  1,
            'status'        =>  1,
            'created_by'      =>  1,
            'updated_by'      =>  1,
            'created_at'        =>  '2017-07-26',
            'updated_at'        =>  '2017-07-26',
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drop foreign key for table `user`

        $this->dropForeignKey(
            'fk-insurance_provider-user_id',
            'insurance_provider'
        );

        // drop foreign key for table `insurance_provider_type`

        $this->dropForeignKey(
            'fk-insurance_provider-insurance_provider_type_id',
            'insurance_provider'
        );

        // drop foreign key for table `insurance_provider_category`

        $this->dropForeignKey(
            'fk-insurance_provider-insurance_provider_category_id',
            'insurance_provider'
        );

        $this->dropIndex('idx-insurance_provider', 'insurance_provider');
        $this->dropTable('insurance_provider');
    }
}
