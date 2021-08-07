<?php

namespace app\modules\Apiv1\models;

class Patologia extends \app\models\Patologia
{
    
    public function fields()
    {
        return ['id_patologia', 'nombre', 'detalle'];
    }
}
