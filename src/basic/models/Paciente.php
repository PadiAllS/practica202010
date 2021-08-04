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
 * @property string|null $ape_nomb_materno
 * @property string|null $ape_nomb_paterno
 * @property string|null $responsable_nombre
 * @property string|null $responsable_telefono
 *
 * @property Obrasocial $obrasocial
 * @property PacientePatologia[] $pacientePatologias
 * @property Patologia[] $patologias
 * @property Turno[] $turnos
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
            [['fecha_nacimiento'], 'safe'],
            [['nombre'], 'string', 'max' => 50],
            [['apellido', 'ape_nomb_materno', 'ape_nomb_paterno', 'responsable_nombre', 'responsable_telefono'], 'string', 'max' => 80],
            [['direccion', 'localidad'], 'string', 'max' => 100],
            [['codigo_postal', 'telefono', 'celular', 'mail', 'sexo', 'tipo_documento', 'nro_documento'], 'string', 'max' => 20],
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
            'ape_nomb_materno' => 'Ape Nomb Materno',
            'ape_nomb_paterno' => 'Ape Nomb Paterno',
            'responsable_nombre' => 'Responsable Nombre',
            'responsable_telefono' => 'Responsable Telefono',
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
     * Gets query for [[Turnos]].
     *
     * @return \yii\db\ActiveQuery|TurnoQuery
     */
    public function getTurnos()
    {
        return $this->hasMany(Turno::className(), ['paciente_id' => 'id_paciente']);
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
