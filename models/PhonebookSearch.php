<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Phonebook;

/**
 * PhonebookSearch represents the model behind the search form of `app\models\Phonebook`.
 */
class PhonebookSearch extends Phonebook
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cl_id'], 'integer'],
            [['number', 'description', 'create_date', 'delete_flag', 'delete_date'], 'safe'],
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
        $query = Phonebook::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if(isset($clientID))
        {
            $query->where(['cl_id' => $clientID]);            
        }

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
            'delete_date' => $this->delete_date,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'delete_flag', $this->delete_flag]);

        return $dataProvider;
    }
}
