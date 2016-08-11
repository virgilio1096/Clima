<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\InfoclimaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Infoclimas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="infoclima-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Infoclima'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ubi',
            'fecha',
            'direccionRafagas',
            'DireccionViento',
            // 'humedadRelativa',
            // 'precipitacion',
            // 'radicionSolar',
            // 'rapidesRafaga',
            // 'rapidesViento',
            // 'temperaturaAire',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
