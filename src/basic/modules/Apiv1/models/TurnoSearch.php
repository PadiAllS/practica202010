<?php

namespace app\modules\Apiv1\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use \app\modules\Apiv1\models\Turno;

/**
 * TurnoSearch represents the model behind the search form of `app\models\Turno`.
 */
class TurnoSearch extends \app\modules\Apiv1\models\Turno
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_turno', 'nro_orden', 'paciente_id', 'medico_id'], 'integer'],
            [['fecha_registro', 'fecha_consulta', 'hora_consulta'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Turno::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params,'');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_turno' => $this->id_turno,
            'nro_orden' => $this->nro_orden,
            'fecha_registro' => $this->fecha_registro,
            'fecha_consulta' => $this->fecha_consulta,
            'hora_consulta' => $this->hora_consulta,
            'paciente_id' => $this->paciente_id,
            'medico_id' => $this->medico_id,
        ]);

        return $dataProvider;
    }
}
