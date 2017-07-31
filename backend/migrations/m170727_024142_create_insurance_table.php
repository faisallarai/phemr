<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `insurance`.
 */
class m170727_024142_create_insurance_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('insurance', [
            'id'            => $this->primaryKey(),
            'policy_number'      => $this->string(25)->notNull(),
            'insurance_provider_id'     => $this->integer()->notNull(),
            'insurance_provider_type_id'     => $this->integer()->notNull(),
            'plan_name'      => $this->string(25)->notNull(),
            'group_number'     => $this->string(25)->notNull(),
            'subscriber_employer_name'     => $this->string(25)->notNull(),
            'subscriber_employer_address'     => $this->string(25)->notNull(),
            'subscriber_employer_city'     => $this->string(25)->notNull(),
            'subscriber_employer_region_id'     => $this->integer()->notNull(),
            'subscriber_employer_country_id'     => $this->integer()->notNull()->defaultValue(1),
            'subscriber_name'     => $this->string()->notNull(),
            'subscriber_relationship_id'     => $this->integer()->notNull(),
            'subscriber_dob'     => $this->date()->notNull(),
            'subscriber_gender_id'     => $this->integer()->notNull(),
            'subscriber_region_id'     => $this->integer()->notNull(),
            'subscriber_country_id'     => $this->integer()->notNull(),
            'subscriber_phone'     => $this->string()->notNull(),
            'subscriber_ssnit'     => $this->string(),
            'copay'     => $this->boolean()->notNull(),
            'accepted'     => $this->boolean()->notNull(),
            'effecive_date'        => $this->date()->notNull(),
            'reg_date'        => $this->date()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'patient_id' => $this->integer()->notNull(),
            'status'        => $this->boolean(),
            'created_by' => $this->integer()->notNull(), 
            'updated_by' => $this->integer()->notNull(),      
            'created_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP',
            'updated_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        // creates index for table `insurance`
        $this->createIndex(
            'idx-insurance',
            'insurance',
            ['id', 'plan_name', 'policy_number' , 'reg_date','group_number' ,'subscriber_name', 'subscriber_dob', 'subscriber_phone', 'subscriber_ssnit', 'effecive_date', 'patient_id', 'insurance_provider_id','insurance_provider_type_id', 'status', 'created_at', 'updated_at']
        );

        // add foreign key for table `user`

        $this->addForeignKey(
            'fk-insurance-user_id',
            'insurance',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // add foreign key for table `insurance_provider`

        $this->addForeignKey(
            'fk-insurance-insurance_provider_id',
            'insurance',
            'insurance_provider_id',
            'insurance_provider',
            'id',
            'CASCADE'
        );

        // add foreign key for table `insurance_provider_type`

        $this->addForeignKey(
            'fk-insurance-insurance_provider_type_id',
            'insurance',
            'insurance_provider_type_id',
            'insurance_provider_type',
            'id',
            'CASCADE'
        );

        // add foreign key for table `patient`

        $this->addForeignKey(
            'fk-insurance-patient_id',
            'insurance',
            'patient_id',
            'patient',
            'id',
            'CASCADE'
        );

        // add foreign key for table `region`

        $this->addForeignKey(
            'fk-insurance-subscriber_employer_region_id',
            'insurance',
            'subscriber_employer_region_id',
            'region',
            'id',
            'CASCADE'
        );

        // add foreign key for table `country`

        $this->addForeignKey(
            'fk-insurance-subscriber_employer_country_id',
            'insurance',
            'subscriber_employer_country_id',
            'country',
            'id',
            'CASCADE'
        );

        // add foreign key for table `gender`

        $this->addForeignKey(
            'fk-insurance-subscriber_gender_id',
            'insurance',
            'subscriber_gender_id',
            'gender',
            'id',
            'CASCADE'
        );

        // add foreign key for table `relationship`

        $this->addForeignKey(
            'fk-insurance-subscriber_relationship_id',
            'insurance',
            'subscriber_relationship_id',
            'relationship',
            'id',
            'CASCADE'
        );

        // add foreign key for table `country`

        $this->addForeignKey(
            'fk-insurance-subscriber_country_id',
            'insurance',
            'subscriber_country_id',
            'country',
            'id',
            'CASCADE'
        );

        // add foreign key for table `region`

        $this->addForeignKey(
            'fk-insurance-subscriber_region_id',
            'insurance',
            'subscriber_region_id',
            'region',
            'id',
            'CASCADE'
        );


        $this->insert('insurance', [
            'id'            =>  1,
            'insurance_provider_id'      =>  1,
            'insurance_provider_type_id'      =>  1,
            'plan_name'     =>  'kofi nhis plan',
            'effecive_date'     =>  '2017-07-26',
            'policy_number'     =>  '784123562',
            'group_number'     =>  '23535632',
            'subscriber_employer_name'     =>  'smsgh',
            'subscriber_employer_address'     =>  'Accra Kokomlemle',
            'subscriber_employer_city'     =>  'Madina',
            'subscriber_employer_region_id'     =>  1,
            'subscriber_employer_country_id'     =>  1,
            'subscriber_name'     =>  'Kofi Abanga',
            'subscriber_phone'     =>  '0208876890',
            'subscriber_relationship_id'     =>  1,
            'subscriber_gender_id'     =>  1,
            'subscriber_region_id'     =>  1,
            'subscriber_country_id'     =>  1,
            'subscriber_dob'     =>  '1975-07-26',
            'reg_date'     =>  '2017-07-26',
            'patient_id'     =>  1,
            'copay'        =>  1,
            'accepted'        =>  1,
            'user_id'     =>  1,
            'status'        =>  1,
            'created_by'     =>  1,
            'updated_by'     =>  1,
            'created_at'     =>  '2017-07-26',
            'updated_at'     =>  '2017-07-26',
        ]);

        $this->insert('insurance', [
            'id'            =>  2,
            'insurance_provider_id'      =>  2,
            'insurance_provider_type_id'      =>  1,
            'plan_name'     =>  'kofi nhis plan',
            'effecive_date'     =>  '2017-07-26',
            'policy_number'     =>  '757646336',
            'group_number'     =>  '6546558756',
            'subscriber_employer_name'     =>  'smsgh',
            'subscriber_employer_address'     =>  'Accra Kokomlemle',
            'subscriber_employer_city'     =>  'Madina',
            'subscriber_employer_region_id'     =>  1,
            'subscriber_employer_country_id'     =>  1,
            'subscriber_name'     =>  'Kofi Abanga',
            'subscriber_phone'     =>  '0208876890',
            'subscriber_relationship_id'     =>  1,
            'subscriber_gender_id'     =>  1,
            'subscriber_region_id'     =>  1,
            'subscriber_country_id'     =>  1,
            'subscriber_dob'     =>  '1981-07-26',
            'reg_date'     =>  '2017-07-26',
            'patient_id'     =>  1,
            'copay'        =>  1,
            'accepted'        =>  1,
            'user_id'     =>  1,
            'status'        =>  1,
            'created_by'     =>  1,
            'updated_by'     =>  1,
            'created_at'     =>  '2017-07-26',
            'updated_at'     =>  '2017-07-26',
        ]);

        $this->insert('insurance', [
            'id'            =>  3,
            'insurance_provider_id'      =>  1,
            'insurance_provider_type_id'      =>  1,
            'plan_name'     =>  'Kwame nhis plan',
            'effecive_date'     =>  '2017-07-26',
            'policy_number'     =>  '689856343655',
            'group_number'     =>  '087463654787',
            'subscriber_employer_name'     =>  'co limited',
            'subscriber_employer_address'     =>  'Madina',
            'subscriber_employer_city'     =>  'Madina',
            'subscriber_employer_region_id'     =>  1,
            'subscriber_employer_country_id'     =>  1,
            'subscriber_dob'     =>  '1983-07-26',
            'subscriber_name'     =>  'Kofi Abanga',
            'subscriber_phone'     =>  '0244789654',
            'subscriber_relationship_id'     =>  1,
            'subscriber_gender_id'     =>  1,
            'subscriber_region_id'     =>  1,
            'subscriber_country_id'     =>  1,
            'reg_date'     =>  '2017-07-26',
            'patient_id'     =>  2,
            'copay'        =>  1,
            'accepted'        =>  1,
            'user_id'     =>  1,
            'status'        =>  1,
            'created_by'     =>  1,
            'updated_by'     =>  1,
            'created_at'     =>  '2017-07-26',
            'updated_at'     =>  '2017-07-26',
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drop foreign key for table `user`

        $this->dropForeignKey(
            'fk-insurance-user_id',
            'insurance'
        );

        // drop foreign key for table `insurance_provider`

        $this->dropForeignKey(
            'fk-insurance-insurance_provider_id',
            'insurance'
        );

        // drop foreign key for table `insurance_provider_type`

        $this->dropForeignKey(
            'fk-insurance-insurance_provider_type_id',
            'insurance'
        );

        // drop foreign key for table `patient`

        $this->dropForeignKey(
            'fk-insurance-patient_id',
            'insurance'
        );

        // drop foreign key for table `region`

        $this->dropForeignKey(
            'fk-insurance-subscriber_region_id',
            'insurance'
        );

        // drop foreign key for table `country`

        $this->dropForeignKey(
            'fk-insurance-subscriber_country_id',
            'insurance'
        );

        // drop foreign key for table `gender`

        $this->dropForeignKey(
            'fk-insurance-subscriber_gender_id',
            'insurance'
        );

        // drop foreign key for table `relationship`

        $this->dropForeignKey(
            'fk-insurance-subscriber_relationship_id',
            'insurance'
        );

        // drop foreign key for table `region`

        $this->dropForeignKey(
            'fk-insurance-subscriber_employer_region_id',
            'insurance'
        );

        // drop foreign key for table `country`

        $this->dropForeignKey(
            'fk-insurance-subscriber_employer_country_id',
            'insurance'
        );

        $this->dropIndex('idx-insurance', 'insurance');

        $this->dropTable('insurance');
    }
}
