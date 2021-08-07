<?php

namespace app\modules\Apiv1\models;

use app\models\Obrasocial;
use app\models\Patologia;
use app\models\Pacientepatologia;
use app\models\PacienteQuery;


class Paciente extends \app\models\Paciente
{

    public function fields()
    {
        return ['id_paciente', 'patologias', 'direccion', 'fecha_nacimiento', 'sexo', 'nro_documento', 'tipo_documento', 'ape_nomb_materno', 'ape_nomb_paterno', 'responsable_nombre', 'responsable_telefono', 'nombre', 'apellido', 'obrasocial_id', 'celular', 'mail', 'telefono', 'localidad', 'codigo_postal',];
    }

    public function getObrasocial()
    {
        return $this->hasOne(Obrasocial::className(), ['id' => 'obrasocial_id']);
    }

    public function getPacientepatologias()
    {
        return $this->hasMany(Pacientepatologia::className(), ['paciente_id' => 'id_paciente']);
    }

    public function getPatologias()
    {
        return $this->hasMany(Patologia::className(), ['id_patologia' => 'patologia_id'])->viaTable('paciente_patologia', ['paciente_id' => 'id_paciente']);
    }

    /**
     * {@inheritdoc}
     * @return PacienteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PacienteQuery(get_called_class());
    }
}
