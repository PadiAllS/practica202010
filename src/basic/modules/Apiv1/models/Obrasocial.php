<?php

namespace app\modules\Apiv1\models;

class Obrasocial extends \app\models\Obrasocial
{
    
    public function fields()
    {
        return ['id', 'nombre', 'detalle'];
    }
}
