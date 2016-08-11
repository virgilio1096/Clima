<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Infoclima */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="infoclima-form">

    <?php $form = ActiveForm::begin(); ?>zz

    <?= $form->field($model, 'ubi')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccionRafagas')->textInput() ?>

    <?= $form->field($model, 'DireccionViento')->textInput() ?>

    <?= $form->field($model, 'humedadRelativa')->textInput() ?>

    <?= $form->field($model, 'precipitacion')->textInput() ?>

    <?= $form->field($model, 'radicionSolar')->textInput() ?>

    <?= $form->field($model, 'rapidesRafaga')->textInput() ?>

    <?= $form->field($model, 'rapidesViento')->textInput() ?>

    <?= $form->field($model, 'temperaturaAire')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
