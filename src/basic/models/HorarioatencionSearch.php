<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Horarioatencion;

/**
 * HorarioatencionSearch represents the model behind the search form of `app\models\Horarioatencion`.
 */
class HorarioatencionSearch extends Horarioatencion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_horarioAtencion'], 'integer'],
            [['dia', 'deste', 'hasta'], 'safe'],
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
        $query = Horarioatencion::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 4]
        ]);

        $this->load($params,'');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_horarioAtencion' => $this->id_horarioAtencion,
            'deste' => $this->deste,
            'hasta' => $this->hasta,
        ]);

        $query->andFilterWhere(['like', 'dia', $this->dia]);

        return $dataProvider;
    }
}
