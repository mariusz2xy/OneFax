<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form of `app\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * {@inheritdoc}
     */

    public $clientName, $groupName;
    public function rules()
    {
        return [
            [['id', 'user_group_id', 'cl_id'], 'integer'],
            [['username', 'password', 'auth_key', 'access_token', 'create_date', 'delete_flag', 'clientName', 'groupName'], 'safe'],
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
        $query = Users::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['username' => SORT_ASC],
                'attributes' => [
                    'username' => [
                        'asc' => ['username' => SORT_ASC],
                        'desc' => ['username' => SORT_DESC],
                    ],
                    'groupName' => [
                        'asc' => ['ug_user_groups.name' => SORT_ASC],
                        'desc' => ['ug_user_groups.name' => SORT_DESC],
                    ],
                    'clientName' => [
                        'asc' => ['cl_clients_list.name' => SORT_ASC],
                        'desc' => ['cl_clients_list.name' => SORT_DESC],
                    ],
                ],
            ],
        ]);

        $query->joinWith('client')
            ->joinWith('userGroups');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_group_id' => $this->user_group_id,
            'cl_id' => $this->cl_id,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'access_token', $this->access_token])
            ->andFilterWhere(['like', 'delete_flag', $this->delete_flag])
            ->andFilterWhere(['like', 'ug_user_groups.name', $this->groupName])
            ->andFilterWhere(['like', 'cl_clients_list.name', $this->clientName]);
        return $dataProvider;
    }
}
