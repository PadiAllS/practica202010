<?php

namespace app\modules\Apiv1\models;

class Medicohorarioatencion extends \app\models\Medicohorarioatencion
{
    
    public function fields()
    {
        return ['medico_id', 'horario_atencion_id'];
    }
}
