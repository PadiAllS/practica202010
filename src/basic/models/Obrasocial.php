<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "obrasocial".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $detalle
 *
 * @property Paciente[] $pacientes
 */
class Obrasocial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obrasocial';
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
            'id' => 'ID',
            'nombre' => 'Nombre',
            'detalle' => 'Detalle',
        ];
    }

    /**
     * Gets query for [[Pacientes]].
     *
     * @return \yii\db\ActiveQuery|PacienteQuery
     */
    public function getPacientes()
    {
        return $this->hasMany(Paciente::className(), ['obrasocial_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ObrasocialQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ObrasocialQuery(get_called_class());
    }
}
