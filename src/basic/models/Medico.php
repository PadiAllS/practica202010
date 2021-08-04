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
 * @property string|null $direccion
 * @property string|null $localidad
 * @property string|null $codigo_postal
 * @property string|null $telefono
 * @property string|null $celular
 * @property string|null $mail
 * @property string|null $fecha_nacimiento
 * @property string|null $sexo
 * @property string|null $tipo_documento
 * @property string|null $nro_documento
 * @property string|null $matricula
 * @property int|null $duracion_consulta
 *
 * @property Especialidad $especialidad
 * @property MedicoHorarioAtencion[] $medicoHorarioAtencions
 * @property HorarioAtencion[] $horarioAtencions
 * @property Turno[] $turnos
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
            [['especialidad_id', 'nombre', 'apellido', 'matricula'], 'required'],
            [['especialidad_id', 'duracion_consulta'], 'integer'],
            [['fecha_nacimiento'], 'safe'],
            [['nombre', 'apellido', 'matricula'], 'string', 'max' => 50],
            [['direccion', 'localidad'], 'string', 'max' => 100],
            [['codigo_postal', 'telefono', 'celular', 'mail', 'sexo', 'tipo_documento', 'nro_documento'], 'string', 'max' => 20],
            [['especialidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidad::className(), 'targetAttribute' => ['especialidad_id' => 'id_especialidad']],
            ['mail', 'email'],
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
            'direccion' => 'Direccion',
            'localidad' => 'Localidad',
            'codigo_postal' => 'Codigo Postal',
            'telefono' => 'Telefono',
            'celular' => 'Celular',
            'mail' => 'Mail',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'sexo' => 'Sexo',
            'tipo_documento' => 'Tipo Documento',
            'nro_documento' => 'Nro Documento',
            'matricula' => 'Matricula',
            'duracion_consulta' => 'Duracion Consulta',
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
     * @return \yii\db\ActiveQuery|MedicohorarioatencionQuery
     */
    public function getMedicoHorarioAtencions()
    {
        return $this->hasMany(MedicoHorarioAtencion::className(), ['medico_id' => 'id_medico']);
    }

    /**
     * Gets query for [[HorarioAtencions]].
     *
     * @return \yii\db\ActiveQuery|HorarioatencionQuery
     */
    public function getHorarioAtencions()
    {
        return $this->hasMany(HorarioAtencion::className(), ['id_horarioAtencion' => 'horario_atencion_id'])->viaTable('medico_horario_atencion', ['medico_id' => 'id_medico']);
    }

    /**
     * Gets query for [[Turnos]].
     *
     * @return \yii\db\ActiveQuery|TurnoQuery
     */
    public function getTurnos()
    {
        return $this->hasMany(Turno::className(), ['medico_id' => 'id_medico']);
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
