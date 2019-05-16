<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Vendedor */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vendedor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendedor-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Vendedor'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'id',
        'nome',
        'telefone',
        'endereco',
        'is_ativo',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerVenda->totalCount){
    $gridColumnVenda = [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
                'valor_total',
        'dt_criacao',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerVenda,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Venda'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnVenda
    ]);
}
?>
    </div>
</div>
