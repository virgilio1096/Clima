<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ubicaclima".
 *
 * @property integer $id
 * @property string $estacion
 * @property string $ubicacion
 * @property string $latitudN
 * @property string $longitudO
 * @property double $altitud
 *
 * @property Infoclima[] $infoclimas
 */
class Conclima extends \yii\db\ActiveRecord
{
    public $fecha;
    public $direccionRafagas;
    public $DireccionViento;
    public $HumedadRelativa;
    public $precipitacion;
    public $radicionSolar;
    public $rapidesRafaga;
    public $rapidesViento;
    public $temperaturaAire;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ubicaclima';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['altitud'], 'number'],
            [['fecha', 'direccionRafagas', 'DireccionViento', 'HumedadRelativa','precipitacion','radicionSolar','rapidesRafaga','rapidesViento','temperaturaAire','estacion', 'ubicacion', 'latitudN', 'longitudO'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'estacion' => Yii::t('app', 'Estacion'),
            'ubicacion' => Yii::t('app', 'Ubicacion'),
            'latitudN' => Yii::t('app', 'Latitud N'),
            'longitudO' => Yii::t('app', 'Longitud O'),
            'altitud' => Yii::t('app', 'Altitud'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfoclimas()
    {
        return $this->hasMany(Infoclima::className(), ['ubi' => 'id']);
    }
}
