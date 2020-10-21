<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medico".
 *
 * @property int $id_medico
 * @property string|null $nombre
 * @property string|null $apellido
 * @property int $especialidad_id
 *
 * @property Especialidad $especialidad
 * @property Medicohorarioatencion[] $medicoHorarioAtencions
 * @property Horarioatencion[] $horarioatencions
 */
class Medico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['especialidad_id'], 'required'],
            [['especialidad_id'], 'integer'],
            [['nombre', 'apellido'], 'string', 'max' => 50],
            [['especialidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidad::className(), 'targetAttribute' => ['especialidad_id' => 'id_especialidad']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_medico' => 'Id Medico',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'especialidad_id' => 'Especialidad ID',
        ];
    }

    /**
     * Gets query for [[Especialidad]].
     *
     * @return \yii\db\ActiveQuery|EspecialidadQuery
     */
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
