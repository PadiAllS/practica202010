<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%horario_atencion}}`.
 */
class m201004_123241_create_horario_atencion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%horario_atencion}}', [
            'id_horarioAtencion' => $this->primaryKey(),
            'dia' => $this->string(50),
            'deste' => $this->time(),
            'hasta' => $this->time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%horario_atencion}}');
    }
}
