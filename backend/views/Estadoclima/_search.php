<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\EstadoclimaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estadoclima-search">

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

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'direccionRafagas') ?>

    <?php // echo $form->field($model, 'DireccionViento') ?>

    <?php // echo $form->field($model, 'humedadRelativa') ?>

    <?php // echo $form->field($model, 'precipitacion') ?>

    <?php // echo $form->field($model, 'radicionSolar') ?>

    <?php // echo $form->field($model, 'rapidesRafaga') ?>

    <?php // echo $form->field($model, 'temperaturaAire') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
