<?php

namespace app\modules\Apiv1\models;

use app\models\medico;
use app\models\Paciente;
use app\models\TurnoQuery;


class Turno extends \app\models\Turno
{
    
    public function fields()
    {
        return ['id_turno', 'nro_orden', 'fecha_registro','fecha_consulta','hora_consulta','paciente','medico'];
    }

    public function getPaciente()
    {
        return $this->hasOne(Paciente::className(), ['id_paciente' => 'paciente_id']);
    }

    
    public function getMedico()
    {
        return $this->hasMany(Medico::className(), ['id_medico' => 'medico_id']);
    }

    public static function find()
    {
        return new TurnoQuery(get_called_class());
    }
    
}
