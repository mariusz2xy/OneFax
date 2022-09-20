<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DidsList;

/**
 * DidsListSearch represents the model behind the search form of `app\models\DidsList`.
 */
class DidsListSearch extends DidsList
{
    /**
     * {@inheritdoc}
     */

    public $clientName;
    public function rules()
    {
        return [
            [['id', 'cl_id', 'delete_flag'], 'integer'],
            [['did', 'clientName', 'create_date', 'delete_date'], 'safe'],
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
        $query = DidsList::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => ['did' => SORT_ASC],
                'attributes' => [
                    'did' => [
                        'asc' => ['did' => SORT_ASC],
                        'desc' => ['did' => SORT_DESC],
                    ],
                    'clientName' => [
                        'asc' => ['cl_clients_list.name' => SORT_ASC],
                        'desc' => ['cl_clients_list.name' => SORT_DESC],
                    ],
                ],
            ],
        ]);

        $query->joinWith('client');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cl_id' => $this->cl_id,
            'create_date' => $this->create_date,
            'delete_flag' => $this->delete_flag,
            'delete_date' => $this->delete_date,
        ]);

        $query->andFilterWhere(['like', 'did', $this->did])
            ->andFilterWhere(['like', 'cl_clients_list.name', $this->clientName]);

        return $dataProvider;
    }
}
