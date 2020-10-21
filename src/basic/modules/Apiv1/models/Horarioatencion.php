<?php

namespace app\modules\Apiv1\models;

class Horarioatencion extends \app\models\Horarioatencion
{
    
    public function fields()
    {
        return ['id_horarioAtencion', 'dia', 'deste', 'hasta'];
    }
}
