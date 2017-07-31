<?php

use yii\db\Migration;

class m170524_195718_insert_data extends Migration
{
    /**
     * @inheritdoc
     */

    public function safeUp()
    {

        $tableOptions = null;

        if ( $this->db->driverName === 'mysql' )
        {
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        // User Table role 1 is staff and 2 is patient and 3 external
        $this->insert('user',array(
            'email'=>'admin@phantomgh.com',
            'username' => 'admin',
            'auth_key' => 'Cd4vPaE-c38uSURcXOOCvfVFCFqyXn-1',
            'password_hash' => '$2y$13$63XwUjt116GA0zFqnKvnRODObKmgeT3OHTiMlb.fgkNhXjnil5OyO',
            'confirmed_at' => '2017-07-26 11:32:41',
            'role' => 1,
            'status' => 10
        ));

        $this->insert('user',array(
            'email'=>'demo@phantomgh.com',
            'username' => 'demo',
            'auth_key' => 'Cd4vPaE-c38uSURcXOOCvfVFCFqyXn-1',
            'password_hash' => '$2y$13$63XwUjt116GA0zFqnKvnRODObKmgeT3OHTiMlb.fgkNhXjnil5OyO',
            'confirmed_at' => '2017-07-26 11:32:41',
            'role' => 2,
            'status' => 10
        ));
    }


    /**
     * @inheritdoc

     */

    public function safeDown()
    {
        echo "m130726_010519_insert_user does not support migration down.\n";
    }
}
