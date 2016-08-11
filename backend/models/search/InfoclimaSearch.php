<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Infoclima;

/**
 * InfoclimaSearch represents the model behind the search form about `app\models\Infoclima`.
 */
class InfoclimaSearch extends Infoclima
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ubi'], 'integer'],
            [['fecha'], 'safe'],
            [['direccionRafagas', 'DireccionViento', 'humedadRelativa', 'precipitacion', 'radicionSolar', 'rapidesRafaga', 'rapidesViento', 'temperaturaAire'], 'number'],
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
        $query = Infoclima::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ubi' => $this->ubi,
            'direccionRafagas' => $this->direccionRafagas,
            'DireccionViento' => $this->DireccionViento,
            'humedadRelativa' => $this->humedadRelativa,
            'precipitacion' => $this->precipitacion,
            'radicionSolar' => $this->radicionSolar,
            'rapidesRafaga' => $this->rapidesRafaga,
            'rapidesViento' => $this->rapidesViento,
            'temperaturaAire' => $this->temperaturaAire,
        ]);

        $query->andFilterWhere(['like', 'fecha', $this->fecha]);

        return $dataProvider;
    }
}
