<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contract;

/**
 * ContractSerach represents the model behind the search form of `app\models\Contract`.
 */
class ContractSerach extends Contract
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_patient', 'id_patient_representative', 'date_to', 'date_do', 'date_ct', 'visible'], 'safe'],
            [['name'], 'safe'],
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
        $query = Contract::find()
            ->joinWith(['patient as p'])
            ->joinWith(['representative as r']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_patient_representative' => $this->id_patient_representative,
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', 'contract.name', $this->name]);
        $query->andFilterWhere(['like', 'p.fullname', $this->id_patient]);
        $query->andFilterWhere(['like', 'p.fullname', $this->id_patient]);

        if($this->date_to)
            $query->andFilterWhere(['>=', 'date_to', strtotime($this->date_to . '00:00:00')])
                ->andFilterWhere(['<=', 'date_to', strtotime($this->date_to . '23:59:59')]);

        if($this->date_do)
            $query->andFilterWhere(['>=', 'date_do', strtotime($this->date_do . '00:00:00')])
                ->andFilterWhere(['<=', 'date_do', strtotime($this->date_do . '23:59:59')]);

        if($this->date_ct)
            $query->andFilterWhere(['>=', 'date_do', strtotime($this->date_ct . '00:00:00')])
                ->andFilterWhere(['<=', 'date_do', strtotime($this->date_ct . '23:59:59')]);

        return $dataProvider;
    }
}