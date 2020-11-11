<?php

namespace app\modules\Apiv1\models;

class Pacientepatologia extends \app\models\Pacientepatologia
{

    public function fields()
    {
        return ['paciente_id', 'patologia_id'];
    }
}
