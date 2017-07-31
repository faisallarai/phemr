<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `patient`.
 */
class m170727_024141_create_patient_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('patient', [
            'id'            => $this->primaryKey(),
            'opd_number'      => $this->string(25)->notNull(),
            'title_id'     => $this->integer()->notNull(),
            'first_name'      => $this->string(25)->notNull(),
            'last_name'     => $this->string(25)->notNull(),
            'other_name'     => $this->string(25),
            'type_id'     => $this->integer()->defaultValue(1),
            'gender_id'     => $this->integer()->notNull(),
            'marital_status_id'     => $this->integer()->notNull(),
            'description'     => $this->text(),
            'dob'        => $this->date()->notNull(),
            'reg_date'        => $this->date()->notNull(),

            'address'     => $this->string(100)->notNull(),
            'personal_phone'     => $this->string(15)->notNull(),
            'work_phone'     => $this->string(15),
            'home_phone'     => $this->string(15),
            'email'     => $this->string(25),
            'house_number'     => $this->string(100),
            'region_id'     => $this->integer(2)->notNull(),
            'city'     => $this->string(25)->notNull(),
            
            'user_id' => $this->integer()->notNull(),
            'status'        => $this->boolean(),
            'created_by' => $this->integer()->notNull(), 
            'updated_by' => $this->integer()->notNull(),      
            'created_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP',
            'updated_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        // creates index for table `patient`
        $this->createIndex(
            'idx-patient',
            'patient',
            ['id', 'opd_number', 'title_id' ,'first_name' ,'last_name', 'marital_status_id','gender_id', 'type_id', 'region_id', 'dob', 'reg_date','personal_phone', 'email', 'status', 'created_at', 'updated_at']
        );

        // add foreign key for table `user`

        $this->addForeignKey(
            'fk-patient-user_id',
            'patient',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // add foreign key for table `gender`

        $this->addForeignKey(
            'fk-patient-gender_id',
            'patient',
            'gender_id',
            'gender',
            'id',
            'CASCADE'
        );

        // add foreign key for table `patient_type`

        $this->addForeignKey(
            'fk-patient-type_id',
            'patient',
            'type_id',
            'patient_type',
            'id',
            'CASCADE'
        );

        // add foreign key for table `marital_status`

        $this->addForeignKey(
            'fk-patient-marital_status_id',
            'patient',
            'marital_status_id',
            'marital_status',
            'id',
            'CASCADE'
        );

        // add foreign key for table `region`

        $this->addForeignKey(
            'fk-patient-region_id',
            'patient',
            'region_id',
            'region',
            'id',
            'CASCADE'
        );

        // add foreign key for table `title`

        $this->addForeignKey(
            'fk-patient-title_id',
            'patient',
            'title_id',
            'title',
            'id',
            'CASCADE'
        );


        $this->insert('patient', [
            'id'            =>  1,
            'opd_number'      =>  '10023456',
            'title_id'     =>  1,
            'first_name'     =>  'Kofi',
            'last_name'     =>  'Abanga',
            'other_name'     =>  '',
            'email'     =>  'kogi@wapom.com',
            'personal_phone'     =>  '0209787678',
            'house_number'     =>  '',
            'work_phone'     =>  '',
            'home_phone'     =>  '',
            'gender_id'     =>  1,
            'marital_status_id'     =>  1,
            'description'     =>  'Kofi Abanga',
            'city'     =>  'Tema',
            'reg_date'     =>  '2017-07-26',
            'dob'     =>  '1986-09-03',
            'city'     =>  'Tema',
            'region_id'     =>  1,
            'type_id'     =>  1,
            'user_id'     =>  1,
            'status'        =>  1,
            'created_by'     =>  1,
            'updated_by'     =>  1,
            'created_at'     =>  '2017-07-26',
            'updated_at'     =>  '2017-07-26',
        ]);

        $this->insert('patient', [
            'id'            =>  2,
            'opd_number'      =>  '10023457',
            'title_id'     =>  2,
            'first_name'     =>  'Ama',
            'last_name'     =>  'Yaw',
            'other_name'     =>  'Lamisi',
            'email'     =>  'ama@wapom.com',
            'personal_phone'     =>  '0209787678',
            'work_phone'     =>  '0209787456',
            'house_number'     =>  'E 234/17 Accra',
            'home_phone'     =>  '',
            'gender_id'     =>  2,
            'marital_status_id'     =>  2,
            'description'     =>  'Kofi Abanga',
            'city'     =>  'Tema',
            'reg_date'     =>  '2017-07-26',
            'dob'     =>  '1979-09-03',
            'city'     =>  'Sofo Line',
            'region_id'     =>  2,
            'type_id'     =>  2,
            'user_id'     =>  2,
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
            'fk-patient-user_id',
            'patient'
        );

        // drop foreign key for table `patient_type`

        $this->dropForeignKey(
            'fk-patient-type_id',
            'patient'
        );

        // drop foreign key for table `gender`

        $this->dropForeignKey(
            'fk-patient-gender_id',
            'patient'
        );

        // drop foreign key for table `marital_status`

        $this->dropForeignKey(
            'fk-patient-marital_status_id',
            'patient'
        );

        // drop foreign key for table `region`

        $this->dropForeignKey(
            'fk-patient-region_id',
            'patient'
        );

        // drop foreign key for table `title`

        $this->dropForeignKey(
            'fk-patient-title_id',
            'patient'
        );

        $this->dropIndex('idx-patient', 'patient');

        $this->dropTable('patient');
    }
}
