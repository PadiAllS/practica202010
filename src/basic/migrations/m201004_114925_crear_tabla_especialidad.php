<?php

use yii\db\Migration;

/**
 * Class m201004_114925_crear_tabla_especialidad
 */
class m201004_114925_crear_tabla_especialidad extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('especialidad', [
            'id_especialidad' => $this->primaryKey(),
            'nombre' => $this->string(50),
            'detalle' => $this->string(80),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('especialidad');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201004_114925_crear_tabla_especialidad cannot be reverted.\n";

        return false;
    }
    */
}
