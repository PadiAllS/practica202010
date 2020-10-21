<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%paciente_patologia}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%paciente}}`
 * - `{{%patologia}}`
 */
class m201017_153241_create_junction_table_for_paciente_and_patologia_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%paciente_patologia}}', [
            'paciente_id' => $this->integer(),
            'patologia_id' => $this->integer(),
            'PRIMARY KEY(paciente_id, patologia_id)',
        ]);

        // creates index for column `paciente_id`
        $this->createIndex(
            '{{%idx-paciente_patologia-paciente_id}}',
            '{{%paciente_patologia}}',
            'paciente_id'
        );

        // add foreign key for table `{{%paciente}}`
        $this->addForeignKey(
            '{{%fk-paciente_patologia-paciente_id}}',
            '{{%paciente_patologia}}',
            'paciente_id',
            '{{%paciente}}',
            'id_paciente',
            'CASCADE'
        );

        // creates index for column `patologia_id`
        $this->createIndex(
            '{{%idx-paciente_patologia-patologia_id}}',
            '{{%paciente_patologia}}',
            'patologia_id'
        );

        // add foreign key for table `{{%patologia}}`
        $this->addForeignKey(
            '{{%fk-paciente_patologia-patologia_id}}',
            '{{%paciente_patologia}}',
            'patologia_id',
            '{{%patologia}}',
            'id_patologia',
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
            '{{%fk-paciente_patologia-paciente_id}}',
            '{{%paciente_patologia}}'
        );

        // drops index for column `paciente_id`
        $this->dropIndex(
            '{{%idx-paciente_patologia-paciente_id}}',
            '{{%paciente_patologia}}'
        );

        // drops foreign key for table `{{%patologia}}`
        $this->dropForeignKey(
            '{{%fk-paciente_patologia-patologia_id}}',
            '{{%paciente_patologia}}'
        );

        // drops index for column `patologia_id`
        $this->dropIndex(
            '{{%idx-paciente_patologia-patologia_id}}',
            '{{%paciente_patologia}}'
        );

        $this->dropTable('{{%paciente_patologia}}');
    }
}
