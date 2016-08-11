<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\InfoclimaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="infoclima-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ubi') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'direccionRafagas') ?>

    <?= $form->field($model, 'DireccionViento') ?>

    <?php // echo $form->field($model, 'humedadRelativa') ?>

    <?php // echo $form->field($model, 'precipitacion') ?>

    <?php // echo $form->field($model, 'radicionSolar') ?>

    <?php // echo $form->field($model, 'rapidesRafaga') ?>

    <?php // echo $form->field($model, 'rapidesViento') ?>

    <?php // echo $form->field($model, 'temperaturaAire') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
