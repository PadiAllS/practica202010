<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%medico_horario_atencion}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%medico}}`
 * - `{{%horario_atencion}}`
 */
class m201004_130535_create_junction_table_for_medico_and_horario_atencion_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%medico_horario_atencion}}', [
            'medico_id' => $this->integer(),
            'horario_atencion_id' => $this->integer(),
            'PRIMARY KEY(medico_id, horario_atencion_id)',
        ]);

        // creates index for column `medico_id`
        $this->createIndex(
            '{{%idx-medico_horario_atencion-medico_id}}',
            '{{%medico_horario_atencion}}',
            'medico_id'
        );

        // add foreign key for table `{{%medico}}`
        $this->addForeignKey(
            '{{%fk-medico_horario_atencion-medico_id}}',
            '{{%medico_horario_atencion}}',
            'medico_id',
            '{{%medico}}',
            'id_medico',
            'CASCADE'
        );

        // creates index for column `horario_atencion_id`
        $this->createIndex(
            '{{%idx-medico_horario_atencion-horario_atencion_id}}',
            '{{%medico_horario_atencion}}',
            'horario_atencion_id'
        );

        // add foreign key for table `{{%horario_atencion}}`
        $this->addForeignKey(
            '{{%fk-medico_horario_atencion-horario_atencion_id}}',
            '{{%medico_horario_atencion}}',
            'horario_atencion_id',
            '{{%horario_atencion}}',
            'id_horarioAtencion',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%medico}}`
        $this->dropForeignKey(
            '{{%fk-medico_horario_atencion-medico_id}}',
            '{{%medico_horario_atencion}}'
        );

        // drops index for column `medico_id`
        $this->dropIndex(
            '{{%idx-medico_horario_atencion-medico_id}}',
            '{{%medico_horario_atencion}}'
        );

        // drops foreign key for table `{{%horario_atencion}}`
        $this->dropForeignKey(
            '{{%fk-medico_horario_atencion-horario_atencion_id}}',
            '{{%medico_horario_atencion}}'
        );

        // drops index for column `horario_atencion_id`
        $this->dropIndex(
            '{{%idx-medico_horario_atencion-horario_atencion_id}}',
            '{{%medico_horario_atencion}}'
        );

        $this->dropTable('{{%medico_horario_atencion}}');
    }
}
