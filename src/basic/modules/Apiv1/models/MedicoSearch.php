<?php

namespace app\modules\Apiv1\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\Apiv1\models\Medico;

/**
 * MedicoSearch represents the model behind the search form of `app\models\Medico`.
 */
class MedicoSearch extends \app\modules\Apiv1\models\Medico
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_medico', 'especialidad_id'], 'integer'],
            [['nombre', 'apellido'], 'safe'],
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
        $query = Medico::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5]
        ]);

        $this->load($params,'');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_medico' => $this->id_medico,
            'especialidad_id' => $this->especialidad_id,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido]);

        return $dataProvider;
    }
}
