<?php

use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Produto */

$this->title = 'Alterar Produto: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Produto', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="produto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::panel(['body' => '<div class="panel-body">'.$this->render('_form', [
        'model' => $model,
    ]).'</div>']); ?>

</div>
