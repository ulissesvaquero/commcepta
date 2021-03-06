<?php

use kartik\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Venda */

$this->title = 'Adicionar Venda';
$this->params['breadcrumbs'][] = ['label' => 'Venda', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venda-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::panel(['body' => '<div class="panel-body">'.$this->render('_form', [
        'model' => $model,
    ]).'</div>']); ?>

</div>
