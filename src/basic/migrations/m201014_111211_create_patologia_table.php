<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%patologia}}`.
 */
class m201014_111211_create_patologia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%patologia}}', [
            'id_patologia' => $this->primaryKey(),
            'nombre' => $this->string(50),
            'detalle' => $this->string(80),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%patologia}}');
        return true;
    }
}
