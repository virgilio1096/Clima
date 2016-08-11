<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Infoclima;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;
use yii2mod\google\maps\markers\GoogleMaps;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ConclimaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->title = Yii::t('app', 'Consultar Estacion Del Clima');
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

 
     <div class="infoclima-form">

    <?php $form = ActiveForm::begin(); ?>
         
    <?=  DateTimePicker::widget([
        'name'=>'fecha',
        'id'=>'fecha',
    'attribute' => 'fecha',
    'language' => 'es',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd HH:ii'
    ],
]);
    
    
    ?>
         
    <div class="form-group">
        <?php
      echo yii\bootstrap\Button::widget([
    'label' => 'Action',
    'options' => ['class' => 'btn-lg'],
]);?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
    
 <?php    
 echo $json;
 echo '<br><br>';
 

 ?> 


<?php


 
$coord = new LatLng(['lat' => 16.756932, 'lng' => -93.129235]);
$map = new Map([
    'center' => $coord,
    'zoom' => 8,
    'scrollwheel'=> false ,
                    'width' => 'auto',
                    'height' => '800',]);

// prosesador de direcciones
$home = new LatLng(['lat' => 16.756932, 'lng' => -93.129235]);
$school = new LatLng(['lat' => 16.74728, 'lng' => 2.8979293346405166]);
$santo_domingo = new LatLng(['lat' => 39.72118906848983, 'lng' => 2.907628202438368]);

// Configura sólo un punto de ruta ( Google permite un máximo de 8 )
$waypoints = [
    new DirectionsWayPoint(['location' => $santo_domingo])
];

$directionsRequest = new DirectionsRequest([
    'origin' => $home,
    'destination' => $school,
    'waypoints' => $waypoints,
    'travelMode' => TravelMode::DRIVING
]);

// Permite configurar la polilínea que hace que la dirección
$polylineOptions = new PolylineOptions([
    'strokeColor' => '#FFAA00',
    'draggable' => true
]);

// Ahora el procesador
$directionsRenderer = new DirectionsRenderer([
    'map' => $map->getName(),
    'polylineOptions' => $polylineOptions
]);

// Por último, el servicio de rutas
$directionsService = new DirectionsService([
    'directionsRenderer' => $directionsRenderer,
    'directionsRequest' => $directionsRequest
]);

// Eso es todo, anexar el guión resultante en el map
$map->appendScript($directionsService->getJs());

// Permite agregar un marcador ahora
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);

// Proporcionar una ventana de información compartida con el marcador
$marker->attachInfoWindow(
    new InfoWindow([
        'content' => '<p>This is my super cool content</p>'
    ])
);

// Añadir marcador para el mapa
$map->addOverlay($marker);

// Ahora vamos a escribir un polígono
$coords='';
 foreach (json_decode($json) as $jsd){
     echo $jsd->latitudN.'<br>';
     
 }

$coords = [
    new LatLng(['lat' => 25.774252, 'lng' => -80.190262]),
    new LatLng(['lat' => 18.466465, 'lng' => -66.118292]),
    new LatLng(['lat' => 32.321384, 'lng' => -64.75737]),
    new LatLng(['lat' => 25.774252, 'lng' => -80.190262])
];

$polygon = new Polygon([
    'paths' => $coords
]);

// Añadir una ventana de información compartida
$polygon->attachInfoWindow(new InfoWindow([
        'content' => '<p>This is my super cool Polygon</p>'
    ]));

// Añadir ahora al mapa
$map->addOverlay($polygon);


// Deja la demostración el BicyclingLayer :)
$bikeLayer = new BicyclingLayer(['map' => $map->getName()]);

// Append its resulting script
$map->appendScript($bikeLayer->getJs());

//Mostar el mapa 
echo $map->display();

?>


