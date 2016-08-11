<?php

namespace app\models;
use yii\grid\GridView;
use app\models\Ubicaclima;

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
class Ubicaclima extends \yii\db\ActiveRecord
{
    public $archivo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ubicaclima';
    }
    
    
function convertDMSToDecimal($latlng) {
    $valid = false;
    $decimal_degrees = 0;
    $degrees = 0; $minutes = 0; $seconds = 0; $direction = 1;

    // Determine if there are extra periods in the input string
    $num_periods = substr_count($latlng, '.');
    if ($num_periods > 1) {
        $temp = preg_replace('/\./', ' ', $latlng, $num_periods - 1); // replace all but last period with delimiter
        $temp = trim(preg_replace('/[a-zA-Z]/','',$temp)); // when counting chunks we only want numbers
        $chunk_count = count(explode(" ",$temp));
        if ($chunk_count > 2) {
            $latlng = preg_replace('/\./', ' ', $latlng, $num_periods - 1); // remove last period
        } else {
            $latlng = str_replace("."," ",$latlng); // remove all periods, not enough chunks left by keeping last one
        }
    }
    
    // Remove unneeded characters
    $latlng = trim($latlng);
    $latlng = str_replace("°"," ",$latlng);
    $latlng = str_replace("'"," ",$latlng);
    $latlng = str_replace("\""," ",$latlng);
    $latlng = substr($latlng,0,1) . str_replace('-', ' ', substr($latlng,1)); // remove all but first dash
    
    if ($latlng != "") {
    // DMS with the direction at the start of the string
        if (preg_match("/^([nsewNSEW]?)\s*(\d{1,3})\s+(\d{1,3})\s+(\d+\.?\d*)$/",$latlng,$matches)) {
            $valid = true;
            $degrees = intval($matches[2]);
            $minutes = intval($matches[3]);
            $seconds = floatval($matches[4]);
            if (strtoupper($matches[1]) == "S" || strtoupper($matches[1]) == "W")
                $direction = -1;
        }
        // DMS with the direction at the end of the string
        elseif (preg_match("/^(-?\d{1,3})\s+(\d{1,3})\s+(\d+(?:\.\d+)?)\s*([nsewNSEW]?)$/",$latlng,$matches)) {
            $valid = true;
            $degrees = intval($matches[1]);
            $minutes = intval($matches[2]);
            $seconds = floatval($matches[3]);
            if (strtoupper($matches[4]) == "S" || strtoupper($matches[4]) == "W" || $degrees < 0) {
                $direction = -1;
                $degrees = abs($degrees);
            }
        }
        if ($valid) {
            // A match was found, do the calculation
            $decimal_degrees = ($degrees + ($minutes / 60) + ($seconds / 3600)) * $direction;
        } else {
            // Decimal degrees with a direction at the start of the string
            if (preg_match("/^([nsewNSEW]?)\s*(\d+(?:\.\d+)?)$/",$latlng,$matches)) {
                $valid = true;
                if (strtoupper($matches[1]) == "S" || strtoupper($matches[1]) == "W")
                    $direction = -1;
                $decimal_degrees = $matches[2] * $direction;
            }
            // Decimal degrees with a direction at the end of the string
            elseif (preg_match("/^(-?\d+(?:\.\d+)?)\s*([nsewNSEW]?)$/",$latlng,$matches)) {
                $valid = true;
                if (strtoupper($matches[2]) == "S" || strtoupper($matches[2]) == "W" || $degrees < 0) {
                    $direction = -1;
                    $degrees = abs($degrees);
                }
                $decimal_degrees = $matches[1] * $direction;
            }
        }
    }
    if ($valid) {
        return $decimal_degrees;
    } else {
        return false;
    }
}


// Code below here is not needed, only for testing the above

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
        
        $estadoclima = new \app\models\Ubicaclima();
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
            
            $regresa1 = $this->convertDMSToDecimal($rowData3[0][1]);
            if($regresa1 == false)
                $estadoclima->latitudN =$rowData3[0][1];
            else
                $estadoclima->latitudN = $regresa1;
                    
            
            $regresa = $this->convertDMSToDecimal($rowData4[0][1]);
            if($regresa == false)
                $estadoclima->longitudO =$rowData4[0][1];
            else
                $estadoclima->longitudO = -$regresa;
            
            $estadoclima->altitud=$rowData5[0][1];
                       
            $estadoclima->save();
            
           
            for ($row = 10; $row < $highestRow; $row++) {
            
            $estadoclim = new \app\models\Infoclima();
            
            $rowData6 = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
            

            $estadoclim->ubi = $estadoclima->id;
            $estadoclim->fecha = $rowData6[0][0];
            $estadoclim->direccionRafagas = $rowData6[0][1];
            $estadoclim->DireccionViento = $rowData6[0][2];
            $estadoclim->humedadRelativa = $rowData6[0][3];
            $estadoclim->precipitacion = $rowData6[0][4];
            $estadoclim->radicionSolar = $rowData6[0][5];
            $estadoclim->temperaturaAire = $rowData6[0][6];
//            $estadoclim->rapidesViento = $rowData6[0][7];
//            $estadoclim->temperaturaAire = $rowData6[0][8];

            $estadoclim->save();

            print_r($estadoclim->getErrors());
        }    
                
                return true;
                } 
                else {
                    return false;
                    }
            }
             return false;
      }

    
//
//    /**
//     * @inheritdoc
//     */
//    public function rules()
//    {
//        return [
//            [['altitud'], 'number'],
//            [['estacion', 'ubicacion', 'latitudN', 'longitudO'], 'string', 'max' => 50],
//        ];
//    }

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
