<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Estadoclima;

/**
 * EstadoclimaSearch represents the model behind the search form about `app\models\Estadoclima`.
 */
class EstadoclimaSearch extends Estadoclima
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fecha'], 'integer'],
            [['estacion', 'ubicacion', 'latitudN', 'longitudO'], 'safe'],
            [['altitud', 'direccionRafagas', 'DireccionViento', 'humedadRelativa', 'precipitacion', 'radicionSolar', 'rapidesRafaga', 'temperaturaAire'], 'number'],
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
        $query = Estadoclima::find();

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
            'altitud' => $this->altitud,
            'fecha' => $this->fecha,
            'direccionRafagas' => $this->direccionRafagas,
            'DireccionViento' => $this->DireccionViento,
            'humedadRelativa' => $this->humedadRelativa,
            'precipitacion' => $this->precipitacion,
            'radicionSolar' => $this->radicionSolar,
            'rapidesRafaga' => $this->rapidesRafaga,
            'temperaturaAire' => $this->temperaturaAire,
        ]);

        $query->andFilterWhere(['like', 'estacion', $this->estacion])
            ->andFilterWhere(['like', 'ubicacion', $this->ubicacion])
            ->andFilterWhere(['like', 'latitudN', $this->latitudN])
            ->andFilterWhere(['like', 'longitudO', $this->longitudO]);

        return $dataProvider;
    }
}
