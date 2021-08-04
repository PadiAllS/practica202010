<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%paciente}}`.
 */
class m210804_130934_add_position_column_to_paciente_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('paciente', 'direccion', $this->string(100));
        $this->addColumn('paciente', 'localidad', $this->string(100));
        $this->addColumn('paciente', 'codigo_postal', $this->string(20));
        $this->addColumn('paciente', 'telefono', $this->string(20));
        $this->addColumn('paciente', 'celular', $this->string(20));
        $this->addColumn('paciente', 'mail', $this->string(20));
        $this->addColumn('paciente', 'fecha_nacimiento', $this->date());
        $this->addColumn('paciente', 'sexo', $this->string(20));
        $this->addColumn('paciente', 'tipo_documento', $this->string(20));
        $this->addColumn('paciente', 'nro_documento', $this->string(20));
        $this->addColumn('paciente', 'ape_nomb_materno', $this->string(80));
        $this->addColumn('paciente', 'ape_nomb_paterno', $this->string(80));
        $this->addColumn('paciente', 'responsable_nombre', $this->string(80));
        $this->addColumn('paciente', 'responsable_telefono', $this->string(80));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('paciente', 'direccion');
        $this->dropColumn('paciente', 'localidad');
        $this->dropColumn('paciente', 'codigo_postal');
        $this->dropColumn('paciente', 'telefono');
        $this->dropColumn('paciente', 'celular');
        $this->dropColumn('paciente', 'mail');
        $this->dropColumn('paciente', 'fecha_nacimiento');
        $this->dropColumn('paciente', 'sexo');
        $this->dropColumn('paciente', 'tipo_documento');
        $this->dropColumn('paciente', 'nro_documento');
        $this->dropColumn('paciente', 'ape_nomb_materno');
        $this->dropColumn('paciente', 'ape_nomb_paterno');
        $this->dropColumn('paciente', 'responsable_nombre');
        $this->dropColumn('paciente', 'responsable_telefono');
    }
}
