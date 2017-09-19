<?php

namespace frontend\models\customer;

use yii\data\ActiveDataProvider;

class CustomerSearch extends CustomerEs
{
    public function rules()
    {
        return [
            ['firstName', 'string']
        ];
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
        $query = CustomerEs::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id'
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        if ($this->firstName) {
            $query->query(['match_phrase_prefix' => ['firstName' => $this->firstName]]);
        }

        return $dataProvider;
    }
}