<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "horario_atencion".
 *
 * @property int $id_horarioAtencion
 * @property string|null $dia
 * @property string|null $deste
 * @property string|null $hasta
 *
 * @property MedicoHorarioAtencion[] $medicoHorarioAtencions
 * @property Medico[] $medicos
 */
class Horarioatencion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'horario_atencion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dia', 'deste', 'hasta'], 'required'],
            [['deste', 'hasta'], 'safe'],
            [['dia'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_horarioAtencion' => 'Id Horario Atencion',
            'dia' => 'Dia',
            'deste' => 'Deste',
            'hasta' => 'Hasta',
        ];
    }

    /**
     * Gets query for [[MedicoHorarioAtencions]].
     *
     * @return \yii\db\ActiveQuery|MedicoHorarioAtencionQuery
     */
    public function getMedicoHorarioAtencions()
    {
        return $this->hasMany(MedicoHorarioAtencion::className(), ['horario_atencion_id' => 'id_horarioAtencion']);
    }

    /**
     * Gets query for [[Medicos]].
     *
     * @return \yii\db\ActiveQuery|MedicoQuery
     */
    public function getMedicos()
    {
        return $this->hasMany(Medico::className(), ['id_medico' => 'medico_id'])->viaTable('medico_horario_atencion', ['horario_atencion_id' => 'id_horarioAtencion']);
    }

    /**
     * {@inheritdoc}
     * @return HorarioatencionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HorarioatencionQuery(get_called_class());
    }
}
