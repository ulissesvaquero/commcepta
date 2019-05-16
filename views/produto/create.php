<?php

use kartik\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Produto */

$this->title = 'Adicionar Produto';
$this->params['breadcrumbs'][] = ['label' => 'Produto', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::panel(['body' => '<div class="panel-body">'.$this->render('_form', [
        'model' => $model,
    ]).'</div>']); ?>

</div>
