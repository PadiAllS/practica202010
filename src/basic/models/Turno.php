<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "turno".
 *
 * @property int $id_turno
 * @property int|null $nro_orden
 * @property string|null $fecha_registro
 * @property string|null $fecha_consulta
 * @property string|null $hora_consulta
 * @property int $paciente_id
 * @property int $medico_id
 *
 * @property Medico $medico
 * @property Paciente $paciente
 */
class Turno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'turno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nro_orden', 'paciente_id', 'medico_id'], 'integer'],
            [['fecha_registro', 'fecha_consulta', 'hora_consulta'], 'safe'],
            [['paciente_id', 'medico_id'], 'required'],
            [['medico_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medico::className(), 'targetAttribute' => ['medico_id' => 'id_medico']],
            [['paciente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Paciente::className(), 'targetAttribute' => ['paciente_id' => 'id_paciente']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_turno' => 'Id Turno',
            'nro_orden' => 'Nro Orden',
            'fecha_registro' => 'Fecha Registro',
            'fecha_consulta' => 'Fecha Consulta',
            'hora_consulta' => 'Hora Consulta',
            'paciente_id' => 'Paciente ID',
            'medico_id' => 'Medico ID',
        ];
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
     * Gets query for [[Paciente]].
     *
     * @return \yii\db\ActiveQuery|PacienteQuery
     */
    public function getPaciente()
    {
        return $this->hasOne(Paciente::className(), ['id_paciente' => 'paciente_id']);
    }

    /**
     * {@inheritdoc}
     * @return TurnoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TurnoQuery(get_called_class());
    }
}
