<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%obrasocial}}`.
 */
class m201017_152502_create_obrasocial_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%obrasocial}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(50),
            'detalle' => $this->string(80),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%obrasocial}}');
        return true;
    }
}
