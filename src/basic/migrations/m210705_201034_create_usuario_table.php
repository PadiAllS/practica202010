<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%usuario}}`.
 */
class m210705_201034_create_usuario_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%usuario}}',
            [
                'id' => $this->primaryKey(),
                'username' => $this->string(80)->notNull(),
                'name' => $this->string(80)->notNull(),
                'password' => $this->string(),
                'authKey' => $this->string(),
                'accessToken' => $this->string(),
                
            ]);

             //Usuario por defecto: admin / pass: 123456
             $this->insert('{{%usuario}}', [
                'username' => 'admin',
                'name' => 'Norberto',
                'password' => '$2y$10$quduV0UOp7x9DSmIRL6At.Mu/7Yk.KCbqqMEK5IbGnRUHtM8xNIm6',
                'authKey' => '0e07255b3578e3be24a464975922c4da',
            ]);
    }
    public function safeDown()
    {
        $this->dropTable('{{%usuario}}');
    }
}
