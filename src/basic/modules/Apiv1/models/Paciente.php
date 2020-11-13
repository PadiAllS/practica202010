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
<<<<<<< HEAD
        return ['id_paciente', 'nombre', 'apellido', 'obrasocial', 'patologias'];
=======
        return ['id_paciente', 'nombre', 'apellido','obrasocial','patologias'];
>>>>>>> cc9bbe6fee51c4d4a8f405083d584071763be1a8
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
