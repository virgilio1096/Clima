<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Estadoclima */

$this->title = 'Create Estadoclima';
$this->params['breadcrumbs'][] = ['label' => 'Estadoclimas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estadoclima-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
