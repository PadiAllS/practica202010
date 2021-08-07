<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paciente_patologia".
 *
 * @property int $paciente_id
 * @property int $patologia_id
 *
 * @property Paciente $paciente
 * @property Patologia $patologia
 */
class Pacientepatologia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paciente_patologia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paciente_id', 'patologia_id'], 'required'],
            [['paciente_id', 'patologia_id'], 'integer'],
            [['paciente_id', 'patologia_id'], 'unique', 'targetAttribute' => ['paciente_id', 'patologia_id']],
            [['paciente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Paciente::className(), 'targetAttribute' => ['paciente_id' => 'id_paciente']],
            [['patologia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patologia::className(), 'targetAttribute' => ['patologia_id' => 'id_patologia']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'paciente_id' => 'Paciente ID',
            'patologia_id' => 'Patologia ID',
        ];
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
     * Gets query for [[Patologia]].
     *
     * @return \yii\db\ActiveQuery|PatologiaQuery
     */
    public function getPatologia()
    {
        return $this->hasOne(Patologia::className(), ['id_patologia' => 'patologia_id']);
    }

    /**
     * {@inheritdoc}
     * @return PacientepatologiaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PacientepatologiaQuery(get_called_class());
    }
}
