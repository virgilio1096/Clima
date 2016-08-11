<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Conclima;
use app\models\Infoclima;
use app\models\Ubicaclima;


/**
 * ConclimaSearch represents the model behind the search form about `app\models\Conclima`.
 */
class ConclimaSearch extends Conclima
{
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['fecha', 'direccionRafagas', 'DireccionViento', 'HumedadRelativa', 'precipitacion', 'radicionSolar', 'rapidesRafaga', 'rapidesViento', 'temperaturaAire', 'estacion', 'ubicacion', 'latitudN', 'longitudO'], 'safe'],
            [['altitud'], 'number'],
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
    public function search($fecha2)
    {
//            $query = Conclima::find();
//
//        // add conditions that should always apply here
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
//
//         $this->load($params);
//        
//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            
//            return $dataProvider;
//        }
        //$query=  Infoclima::findAll(['fecha'=>$fecha2]);
                   $conexion=  Yii::$app->db;
                //$query = (new \yii\db\Query())
                    $sql='SELECT * FROM ubicaclima inner join infoclima on ubicaclima.id=infoclima.ubi where fecha="'.$fecha2.'"';
                        $comando=$conexion->createCommand($sql);
                        $dataReader=$comando->query();
                        return $row=$dataReader->readAll();
                        //->innerJoin('infoclima','infoclima.ubi')
                        //->select('*')->distinct()->from('ubicaclima')
                        //->andWhere(['like', 'fecha', $params])->all();
                
  

        //return $query;
    }
}
