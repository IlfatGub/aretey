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

    public $date_ct_to;
    public $date_ct_do;
    public $patient_surname;
    public $patient_name;
    public $patient_patronymic;
    public $patient_role;
    public $patient_brithday;
    public $patient_fullname;
    public $patient_id;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_patient', 'id_patient_representative', 'date_to', 'date_do', 'date_ct', 'visible'], 'safe'],
            [['name', 'date_ct_to', 'date_ct_do'], 'safe'],
            [['patient_patronymic', 'patient_role', 'patient_surname', 'patient_brithday', 'patient_name', 'patient_name','patient_fullname','date_range','patient_id'], 'safe'],
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
            ->joinWith(['patient'])
            ->joinWith(['representative']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

                
        $dataProvider->sort->attributes['patient_role'] = [
            'asc' => [Patient::tableName().'.phone' => SORT_ASC],
            'desc' => [Patient::tableName().'.phone' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['patient_brithday'] = [
            'asc' => [Patient::tableName().'.brithday' => SORT_ASC],
            'desc' => [Patient::tableName().'.brithday' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['patient_fullname'] = [
            'asc' => [Patient::tableName().'.fullname' => SORT_ASC],
            'desc' => [Patient::tableName().'.fullname' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['patient_surname'] = [
            'asc' => [Patient::tableName().'.surname' => SORT_ASC],
            'desc' => [Patient::tableName().'.surname' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['patient_name'] = [
            'asc' => [Patient::tableName().'.name' => SORT_ASC],
            'desc' => [Patient::tableName().'.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['patient_patronymic'] = [
            'asc' => [Patient::tableName().'.patronymic' => SORT_ASC],
            'desc' => [Patient::tableName().'.patronymic' => SORT_DESC],
        ];

        $this->load($params);

        $this->date_ct_to = array_shift(explode('/', $this->date_range));
        $this->date_ct_do = array_pop(explode('/', $this->date_range));

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_patient_representative' => $this->id_patient_representative,
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', Patient::tableName().'.phone', $this->patient_role]);
        $query->andFilterWhere(['like', Patient::tableName().'.surname', $this->patient_surname]);
        $query->andFilterWhere(['like', Patient::tableName().'.name', $this->patient_name]);
        $query->andFilterWhere(['like', Patient::tableName().'.fullname', $this->patient_fullname]);
        $query->andFilterWhere(['like', Patient::tableName().'.id', $this->patient_id]);
        $query->andFilterWhere(['like', Patient::tableName().'.patronymic', $this->patient_patronymic]);
        $query->andFilterWhere(['like', 'contract.name', $this->name]);

        if ($this->patient_brithday)
            $query->andFilterWhere(['>=', Patient::tableName().'.brithday', strtotime($this->patient_brithday . '00:00:00')])
                ->andFilterWhere(['<=', Patient::tableName().'.brithday', strtotime($this->patient_brithday . '23:59:59')]);

        if ($this->date_ct_to)
            $query->andFilterWhere(['>=', 'date_ct', strtotime($this->date_ct_to . '00:00:00')])
                ->andFilterWhere(['<=', 'date_ct', strtotime($this->date_ct_do . '23:59:59')]);

        $query->andFilterWhere(['is', 'contract.visible', new \yii\db\Expression('null')]);

        return $dataProvider;
    }
}
