<?php

namespace app\modules\Apiv1\models;

class Medico extends \app\models\Medico
{
    
    public function fields()
    {
        return ['id_medico', 'nombre', 'apellido','especialidad','horarioatencions'];
    }

    public function getEspecialidad()
    {
        return $this->hasOne(Especialidad::className(), ['id_especialidad' => 'especialidad_id']);
    }

    /**
     * Gets query for [[MedicoHorarioAtencions]].
     *
     * @return \yii\db\ActiveQuery|MedicoHorarioAtencionQuery
     */
    public function getMedicohorarioatencions()
    {
        return $this->hasMany(Medicohorarioatencion::className(), ['medico_id' => 'id_medico']);
    }

    /**
     * Gets query for [[HorarioAtencions]].
     *
     * @return \yii\db\ActiveQuery|HorarioAtencionQuery
     */
    public function getHorarioatencions()
    {
        return $this->hasMany(Horarioatencion::className(), ['id_horarioAtencion' => 'horario_atencion_id'])->viaTable('medico_horario_atencion', ['medico_id' => 'id_medico']);
    }

    /**
     * {@inheritdoc}
     * @return MedicoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MedicoQuery(get_called_class());
    }

    
}
