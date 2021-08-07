<?php

namespace app\modules\Apiv1\models;

class Especialidad extends \app\models\Especialidad
{
    
    public function fields()
    {
        return ['id_especialidad', 'nombre', 'detalle'];
    }
}
