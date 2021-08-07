<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%medico}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%especialidad}}`
 */
class m201004_130026_create_medico_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%medico}}', [
            'id_medico' => $this->primaryKey(),
            'nombre' => $this->string(50),
            'apellido' => $this->string(50),
            'especialidad_id' => $this->integer()->notNull(),
            


        ]);

        // creates index for column `especialidad_id`
        $this->createIndex(
            '{{%idx-medico-especialidad_id}}',
            '{{%medico}}',
            'especialidad_id'
        );

        // add foreign key for table `{{%especialidad}}`
        $this->addForeignKey(
            '{{%fk-medico-especialidad_id}}',
            '{{%medico}}',
            'especialidad_id',
            '{{%especialidad}}',
            'id_especialidad',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%especialidad}}`
        $this->dropForeignKey(
            '{{%fk-medico-especialidad_id}}',
            '{{%medico}}'
        );

        // drops index for column `especialidad_id`
        $this->dropIndex(
            '{{%idx-medico-especialidad_id}}',
            '{{%medico}}'
        );

        $this->dropTable('{{%medico}}');
    }
}
