<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paciente".
 *
 * @property int $id_paciente
 * @property string|null $nombre
 * @property string|null $apellido
 * @property int $obrasocial_id
 *
 * @property Obrasocial $obrasocial
 * @property PacientePatologia[] $pacientePatologias
 * @property Patologia[] $patologias
 */
class Paciente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paciente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['obrasocial_id'], 'required'],
            [['obrasocial_id'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            [['apellido'], 'string', 'max' => 80],
            [['obrasocial_id'], 'exist', 'skipOnError' => true, 'targetClass' => Obrasocial::className(), 'targetAttribute' => ['obrasocial_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_paciente' => 'Id Paciente',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'obrasocial_id' => 'Obrasocial ID',
        ];
    }

    /**
     * Gets query for [[Obrasocial]].
     *
     * @return \yii\db\ActiveQuery|ObrasocialQuery
     */
    public function getObrasocial()
    {
        return $this->hasOne(Obrasocial::className(), ['id' => 'obrasocial_id']);
    }

    /**
     * Gets query for [[PacientePatologias]].
     *
     * @return \yii\db\ActiveQuery|PacientepatologiaQuery
     */
    public function getPacientePatologias()
    {
        return $this->hasMany(PacientePatologia::className(), ['paciente_id' => 'id_paciente']);
    }

    /**
     * Gets query for [[Patologias]].
     *
     * @return \yii\db\ActiveQuery|PatologiaQuery
     */
    public function getPatologias()
    {
        return $this->hasMany(Patologia::className(), ['id_patologia' => 'patologia_id'])->viaTable('paciente_patologia', ['paciente_id' => 'id_paciente']);
    }

    /**
     * {@inheritdoc}
     * @return PacienteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PacienteQuery(get_called_class());
    }
}
