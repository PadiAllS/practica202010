<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "especialidad".
 *
 * @property int $id_especialidad
 * @property string|null $nombre
 * @property string|null $detalle
 *
 * @property Medico[] $medicos
 */
class Especialidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'especialidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre','detalle'], 'required'],
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
            'id_especialidad' => 'Id Especialidad',
            'nombre' => 'Nombre',
            'detalle' => 'Detalle',
        ];
    }

    /**
     * Gets query for [[Medicos]].
     *
     * @return \yii\db\ActiveQuery|MedicoQuery
     */
    public function getMedicos()
    {
        return $this->hasMany(Medico::className(), ['especialidad_id' => 'id_especialidad']);
    }

    /**
     * {@inheritdoc}
     * @return EspecialidadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EspecialidadQuery(get_called_class());
    }
}
