<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%turno}}`.
 */
class m201117_012313_create_turno_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%turno}}', [
            'id_turno' => $this->primaryKey(),
            'nro_orden' => $this->integer(11),
            'fecha_registro' => $this->date(),
            'fecha_consulta' => $this->date(),
            'hora_consulta' => $this->time(),
            'paciente_id' =>  $this->integer()->notNull(),
            'medico_id' =>  $this->integer()->notNull(),
            
        ]);

        // creates index for column `paciente_id`
        $this->createIndex(
            '{{%idx-turno-paciente_id}}',
            '{{%turno}}',
            'paciente_id'
        );

        // add foreign key for table `{{%paciente}}`
        $this->addForeignKey(
            '{{%fk-turno-paciente_id}}',
            '{{%turno}}',
            'paciente_id',
            '{{%paciente}}',
            'id_paciente',
            'CASCADE'
        );
        // creates index for column `medico_id`
        $this->createIndex(
            '{{%idx-turno-medico_id}}',
            '{{%turno}}',
            'medico_id'
        );

        // add foreign key for table `{{%medico}}`
        $this->addForeignKey(
            '{{%fk-turno-medico_id}}',
            '{{%turno}}',
            'medico_id',
            '{{%medico}}',
            'id_medico',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%paciente}}`
        $this->dropForeignKey(
            '{{%fk-turno-paciente_id}}',
            '{{%turno}}'
        );

        // drops index for column `paciente_id`
        $this->dropIndex(
            '{{%idx-turno-paciente_id}}',
            '{{%turno}}'
        );
        // drops foreign key for table `{{%medico}}`
        $this->dropForeignKey(
            '{{%fk-turno-medico_id}}',
            '{{%turno}}'
        );

        // drops index for column `paciente_id`
        $this->dropIndex(
            '{{%idx-turno-medico_id}}',
            '{{%turno}}'
        );

        $this->dropTable('{{%turno}}');
    }
}
