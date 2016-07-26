<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estadoclima".
 *
 * @property integer $id
 * @property string $estacion
 * @property string $ubicacion
 * @property string $latitudN
 * @property string $longitudO
 * @property double $altitud
 * @property string $fecha
 * @property double $direccionRafagas
 * @property double $DireccionViento
 * @property double $humedadRelativa
 * @property double $precipitacion
 * @property double $radicionSolar
 * @property double $rapidesRafaga
 * @property double $temperaturaAire
 */
class Estadoclima extends \yii\db\ActiveRecord
{
    public $archivo;
    /**
     * @inheritdoc
     */
    
    public static function tableName()
    {
        return 'estadoclima';
    }

    public function upload($id) {
            if(!$this->archivo==null){
            if($this->archivo->saveAs('archivosExcel/'.$id.'.xlsx')) {
    

        $inputFile = '../web/archivosExcel/'.$id.'.xlsx';
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);
        } catch (Exception $e) {
            die('Error');
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 10; $row < $highestRow; $row++) {

            $estadoclima = new \app\models\Estadoclima();
            $valor1 = 2;
            $valor2 = 3;
            $valor3 = 4;
            $valor4 = 5;
            $valor5 = 6;

            $rowData1 = $sheet->rangeToArray('A' . $valor1 . ':' . $highestColumn . $valor1, NULL, TRUE, FALSE);
            $rowData2 = $sheet->rangeToArray('A' . $valor2 . ':' . $highestColumn . $valor2, NULL, TRUE, FALSE);
            $rowData3 = $sheet->rangeToArray('A' . $valor3 . ':' . $highestColumn . $valor3, NULL, TRUE, FALSE);
            $rowData4 = $sheet->rangeToArray('A' . $valor4 . ':' . $highestColumn . $valor4, NULL, TRUE, FALSE);
            $rowData5 = $sheet->rangeToArray('A' . $valor5 . ':' . $highestColumn . $valor5, NULL, TRUE, FALSE);

            $estadoclima->estacion = $rowData1[0][1];
            $estadoclima->ubicacion = $rowData2[0][1];
            $estadoclima->latitudN = $rowData3[0][1];
            $estadoclima->longitudO = $rowData4[0][1];
            $estadoclima->altitud = $rowData5[0][1];


            
            $rowData6 = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            $estadoclima->fecha = $rowData6[0][0];
            $estadoclima->direccionRafagas = $rowData6[0][1];
            $estadoclima->DireccionViento = $rowData6[0][2];
            $estadoclima->humedadRelativa = $rowData6[0][3];
            $estadoclima->precipitacion = $rowData6[0][4];
            $estadoclima->radicionSolar = $rowData6[0][5];
            $estadoclima->rapidesRafaga = $rowData6[0][6];
            $estadoclima->rapidesRafaga = $rowData6[0][7];
            $estadoclima->temperaturaAire = $rowData6[0][8];

            $estadoclima->save();

            print_r($estadoclima->getErrors());
        }    
                
                return true;
                } 
                else {
                    return false;
                    }
            }
             return false;
      }
    /**
     * @inheritdoc
     */

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
            'fecha' => Yii::t('app', 'Fecha'),
            'direccionRafagas' => Yii::t('app', 'Direccion Rafagas'),
            'DireccionViento' => Yii::t('app', 'Direccion Viento'),
            'humedadRelativa' => Yii::t('app', 'Humedad Relativa'),
            'precipitacion' => Yii::t('app', 'Precipitacion'),
            'radicionSolar' => Yii::t('app', 'Radicion Solar'),
            'rapidesRafaga' => Yii::t('app', 'Rapides Rafaga'),
            'temperaturaAire' => Yii::t('app', 'Temperatura Aire'),
        ];
    }
}
