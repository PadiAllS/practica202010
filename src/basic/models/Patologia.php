<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patologia".
 *
 * @property int $id_patologia
 * @property string|null $nombre
 * @property string|null $detalle
 *
 * @property PacientePatologia[] $pacientePatologias
 * @property Paciente[] $pacientes
 */
class Patologia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patologia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'detalle'], 'required'],
            [['nombre'], 'string', 'max' => 50],
            [['detalle'], 'string', 'max' => 80],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_patologia' => 'Id Patologia',
            'nombre' => 'Nombre',
            'detalle' => 'Detalle',
        ];
    }

    /**
     * Gets query for [[PacientePatologias]].
     *
     * @return \yii\db\ActiveQuery|PacientePatologiaQuery
     */
    public function getPacientePatologias()
    {
        return $this->hasMany(PacientePatologia::className(), ['patologia_id' => 'id_patologia']);
    }

    /**
     * Gets query for [[Pacientes]].
     *
     * @return \yii\db\ActiveQuery|PacienteQuery
     */
    public function getPacientes()
    {
        return $this->hasMany(Paciente::className(), ['id_paciente' => 'paciente_id'])->viaTable('paciente_patologia', ['patologia_id' => 'id_patologia']);
    }

    /**
     * {@inheritdoc}
     * @return PatologiaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PatologiaQuery(get_called_class());
    }
}
