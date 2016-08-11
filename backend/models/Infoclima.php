<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "infoclima".
 *
 * @property integer $id
 * @property integer $ubi
 * @property string $fecha
 * @property double $direccionRafagas
 * @property double $DireccionViento
 * @property double $humedadRelativa
 * @property double $precipitacion
 * @property double $radicionSolar
 * @property double $rapidesRafaga
 * @property double $rapidesViento
 * @property double $temperaturaAire
 *
 * @property Ubicaclima $ubi0
 */
class Infoclima extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'infoclima';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ubi'], 'integer'],
            [['direccionRafagas', 'DireccionViento', 'humedadRelativa', 'precipitacion', 'radicionSolar', 'rapidesRafaga', 'rapidesViento', 'temperaturaAire'], 'number'],
            [['fecha'], 'string', 'max' => 100],
            [['ubi'], 'exist', 'skipOnError' => true, 'targetClass' => Ubicaclima::className(), 'targetAttribute' => ['ubi' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ubi' => Yii::t('app', 'Ubi'),
            'fecha' => Yii::t('app', 'Fecha'),
            'direccionRafagas' => Yii::t('app', 'Direccion Rafagas'),
            'DireccionViento' => Yii::t('app', 'Direccion Viento'),
            'humedadRelativa' => Yii::t('app', 'Humedad Relativa'),
            'precipitacion' => Yii::t('app', 'Precipitacion'),
            'radicionSolar' => Yii::t('app', 'Radicion Solar'),
            'rapidesRafaga' => Yii::t('app', 'Rapides Rafaga'),
            'rapidesViento' => Yii::t('app', 'Rapides Viento'),
            'temperaturaAire' => Yii::t('app', 'Temperatura Aire'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUbi0()
    {
        return $this->hasOne(Ubicaclima::className(), ['id' => 'ubi']);
    }
}
