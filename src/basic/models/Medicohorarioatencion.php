<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medico_horario_atencion".
 *
 * @property int $medico_id
 * @property int $horario_atencion_id
 *
 * @property Horarioatencion $horarioatencion
 * @property Medico $medico
 */
class Medicohorarioatencion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medico_horario_atencion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['medico_id', 'horario_atencion_id'], 'required'],
            [['medico_id', 'horario_atencion_id'], 'integer'],
            [['medico_id', 'horario_atencion_id'], 'unique', 'targetAttribute' => ['medico_id', 'horario_atencion_id']],
            [['horario_atencion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Horarioatencion::className(), 'targetAttribute' => ['horario_atencion_id' => 'id_horarioAtencion']],
            [['medico_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medico::className(), 'targetAttribute' => ['medico_id' => 'id_medico']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'medico_id' => 'Medico ID',
            'horario_atencion_id' => 'Horario Atencion ID',
        ];
    }

    /**
     * Gets query for [[HorarioAtencion]].
     *
     * @return \yii\db\ActiveQuery|HorarioAtencionQuery
     */
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
