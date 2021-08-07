<?php

namespace app\modules\Apiv1\models;

use app\models\Medico;
use app\models\Horarioatencion;
// use app\models\Medicohorarioatencion;
use app\models\MedicohorarioatencionQuery;


class Medicohorarioatencion extends \app\models\Medicohorarioatencion
{
    
    public function fields()
    {
        return ['medico_id', 'horario_atencion_id', 'horarioAtencion', 'medico'];

    }

    public function getHorarioAtencion()
    {
        return $this->hasOne(Horarioatencion::className(), ['id_horarioAtencion' => 'horario_atencion_id']);
    }

    /**
     * Gets query for [[Medico]].
     *
     * @return \yii\db\ActiveQuery|MedicoQuery
     */
    public function getMedico()
    {
        return $this->hasOne(Medico::className(), ['id_medico' => 'medico_id']);
    }

    /**
     * {@inheritdoc}
     * @return MedicohorarioatencionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MedicohorarioatencionQuery(get_called_class());
    }
}
