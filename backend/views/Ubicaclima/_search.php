<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\UbicaclimaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ubicaclima-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'estacion') ?>

    <?= $form->field($model, 'ubicacion') ?>

    <?= $form->field($model, 'latitudN') ?>

    <?= $form->field($model, 'longitudO') ?>

    <?php // echo $form->field($model, 'altitud') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
