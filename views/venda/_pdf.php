<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Venda */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Venda', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venda-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Venda'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'id',
        [
                'attribute' => 'vendedor.id',
                'label' => 'Vendedor'
            ],
        'valor_total',
        'dt_criacao',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerVendaProduto->totalCount){
    $gridColumnVendaProduto = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'produto.id',
                'label' => 'Produto'
            ],
        'qtd',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerVendaProduto,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Venda Produto'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnVendaProduto
    ]);
}
?>
    </div>
</div>
