<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `patient_type`.
 */
class m170726_203618_create_patient_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('patient_type', [
            'id'            => $this->primaryKey(),
            'name'      => $this->string(25),
            'description'     => $this->text(),
            'status'        => $this->boolean(),
            'created_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP',
            'updated_at'    => Schema::TYPE_TIMESTAMP. ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        // creates index for table `title`
        $this->createIndex(
            'idx-patient_type',
            'patient_type',
            ['id' , 'name', 'status', 'created_at', 'updated_at']
        );


        $this->insert('patient_type', [
            'id'            =>  1,
            'name'      =>  'Mr.',
            'status'        =>  1,
            'description'     =>  '',
        ]);

        $this->insert('patient_type', [
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
        $this->dropIndex('idx-patient_type', 'patient_type');
        $this->dropTable('patient_type');
    }
}
