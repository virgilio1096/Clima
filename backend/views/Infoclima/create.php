<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Infoclima */

$this->title = Yii::t('app', 'Create Infoclima');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Infoclimas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="infoclima-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
