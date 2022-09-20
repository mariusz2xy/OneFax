<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FaxesList;

/**
 * FaxesListSearch represents the model behind the search form of `app\models\FaxesList`.
 */
class FaxesListSearch extends FaxesList
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cl_id', 'delete_flag'], 'integer'],
            [['caller_number', 'called_number', 'direction', 'call_id', 'event', 'description', 'type', 'date', 'delete_date'], 'safe'],
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
    public function search($params, $clientID = null)
    {
        if(isset($clientID))
        {
            $query = FaxesList::find()
                ->where(['cl_id' => $clientID]);
        } else {
            $query = FaxesList::find();
        }
        

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['date' => SORT_DESC],
                'attributes' => [
                    'date' => [
                        'asc' => ['date' => SORT_ASC],
                        'desc' => ['date' => SORT_DESC],
                    ],
                    'caller_number' => [
                        'asc' => ['caller_number' => SORT_ASC],
                        'desc' => ['caller_number' => SORT_DESC],
                    ],
                    'called_number' => [
                        'asc' => ['called_number' => SORT_ASC],
                        'desc' => ['called_number' => SORT_DESC],
                    ],
                ],
            ],
        ]);

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
            'delete_flag' => $this->delete_flag,
            'delete_date' => $this->delete_date,
        ]);

        $query->andFilterWhere(['like', 'caller_number', $this->caller_number])
            ->andFilterWhere(['like', 'called_number', $this->called_number])
            ->andFilterWhere(['like', 'direction', $this->direction])
            ->andFilterWhere(['like', 'call_id', $this->call_id])
            ->andFilterWhere(['like', 'event', $this->event])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'date', $this->date]);

        return $dataProvider;
    }
}
