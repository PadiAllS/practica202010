<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pacientepatologia;

/**
 * PacientepatologiaSearch represents the model behind the search form of `app\models\Pacientepatologia`.
 */
class PacientepatologiaSearch extends Pacientepatologia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paciente_id', 'patologia_id'], 'integer'],
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
        $query = Pacientepatologia::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'paciente_id' => $this->paciente_id,
            'patologia_id' => $this->patologia_id,
        ]);

        return $dataProvider;
    }
}
