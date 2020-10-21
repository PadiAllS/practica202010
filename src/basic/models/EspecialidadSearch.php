<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Especialidad;

/**
 * EspecialidadSearch represents the model behind the search form of `app\models\Especialidad`.
 */
class EspecialidadSearch extends Especialidad
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_especialidad'], 'integer'],
            [['nombre', 'detalle'], 'safe'],
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
        $query = Especialidad::find();

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
            'id_especialidad' => $this->id_especialidad,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'detalle', $this->detalle]);

        return $dataProvider;
    }
}
