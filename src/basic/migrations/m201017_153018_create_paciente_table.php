<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%paciente}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%obrasocial}}`
 */
class m201017_153018_create_paciente_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%paciente}}', [
            'id_paciente' => $this->primaryKey(),
            'nombre' => $this->string(50),
            'apellido' => $this->string(80),
            'obrasocial_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `obrasocial_id`
        $this->createIndex(
            '{{%idx-paciente-obrasocial_id}}',
            '{{%paciente}}',
            'obrasocial_id'
        );

        // add foreign key for table `{{%obrasocial}}`
        $this->addForeignKey(
            '{{%fk-paciente-obrasocial_id}}',
            '{{%paciente}}',
            'obrasocial_id',
            '{{%obrasocial}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%obrasocial}}`
        $this->dropForeignKey(
            '{{%fk-paciente-obrasocial_id}}',
            '{{%paciente}}'
        );

        // drops index for column `obrasocial_id`
        $this->dropIndex(
            '{{%idx-paciente-obrasocial_id}}',
            '{{%paciente}}'
        );

        $this->dropTable('{{%paciente}}');
    }
}
