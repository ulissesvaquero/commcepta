<?php

use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vendedor */

$this->title = 'Alterar Vendedor: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vendedor', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vendedor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::panel(['body' => '<div class="panel-body">'.$this->render('_form', [
        'model' => $model,
    ]).'</div>']); ?>

</div>
