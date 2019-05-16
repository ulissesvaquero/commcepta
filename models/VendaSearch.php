<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Venda;

/**
 * app\models\VendaSearch represents the model behind the search form about `app\models\Venda`.
 */
 class VendaSearch extends Venda
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vendedor_id'], 'integer'],
            [['valor_total'], 'number'],
            [['dt_criacao'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Venda::find();
        
        $query->andWhere('is_ativo <>  0');

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
            'id' => $this->id,
            'vendedor_id' => $this->vendedor_id,
            'valor_total' => $this->valor_total,
            'dt_criacao' => $this->dt_criacao,
        ]);

        return $dataProvider;
    }
}
