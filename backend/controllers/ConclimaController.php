<?php

namespace backend\controllers;

use Yii;
use app\models\Conclima;
use app\models\search\ConclimaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Infoclima;
use app\models\Ubicaclima;
/**
 * ConclimaController implements the CRUD actions for Conclima model.
 */
class ConclimaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Conclima models.
     * @return mixed
     */
    


    public function actionIndex()
    {
        
        //$fecha=null;
        $fecha2='';
        if (isset($_POST['fecha']))
        {
            $fecha2=$_POST['fecha'];  

        }     
//        return $fecha2;
        $searchModel = new ConclimaSearch();        
        $model=new ConclimaSearch();
        $dataProvider = $searchModel->search($fecha2);       
        
        return $this->render('index',['json'=>json_encode($dataProvider),
        'searchModel' => $searchModel,'model'=>$model]);
    }
        
        
    
        public function actionBusca($fecha2) 
                
        {
            
            $model = new ConclimaSearch();
            return  $model->search($fecha2);
            
        }
    
}
