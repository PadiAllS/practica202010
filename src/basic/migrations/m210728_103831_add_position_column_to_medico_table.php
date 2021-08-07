<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%medico}}`.
 */
class m210728_103831_add_position_column_to_medico_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('medico', 'direccion', $this->string(100));
        $this->addColumn('medico', 'localidad', $this->string(100));
        $this->addColumn('medico', 'codigo_postal', $this->string(20));
        $this->addColumn('medico', 'telefono', $this->string(20));
        $this->addColumn('medico', 'celular', $this->string(20));
        $this->addColumn('medico', 'mail', $this->string(20));
        $this->addColumn('medico', 'fecha_nacimiento', $this->date());
        $this->addColumn('medico', 'sexo', $this->string(20));
        $this->addColumn('medico', 'tipo_documento', $this->string(20));
        $this->addColumn('medico', 'nro_documento', $this->string(20));
        $this->addColumn('medico', 'matricula', $this->string(50));
        $this->addColumn('medico', 'duracion_consulta', $this->integer(10));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('medico', 'direccion');
        $this->dropColumn('medico', 'localidad');
        $this->dropColumn('medico', 'codigo_postal');
        $this->dropColumn('medico', 'telefono');
        $this->dropColumn('medico', 'celular');
        $this->dropColumn('medico', 'mail');
        $this->dropColumn('medico', 'fecha_nacimiento');
        $this->dropColumn('medico', 'sexo');
        $this->dropColumn('medico', 'tipo_documento');
        $this->dropColumn('medico', 'nro_documento');
        $this->dropColumn('medico', 'matricula');
        $this->dropColumn('medico', 'duracion_consulta');
    }
}
