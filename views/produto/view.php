<?php

use kartik\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Produto */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Produto', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Produto'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            
            <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Deseja realmente remover este item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'id',
        'nome',
        'descricao:ntext',
        'valor',
        'is_ativo',
    ];
?>
        <div class="col-lg-12">
            <?= Html::panel([
                'body' => '<div class="panel-body">'.DetailView::widget([
                    'model' => $model,
                    'attributes' => $gridColumn
                ]).'</div>'
            ]);
            ?>
        </div>
    </div>
    
    <div class="row">
<?php
if($providerVendaProduto->totalCount){
    $gridColumnVendaProduto = [
        ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'venda.id',
                'label' => 'Venda'
            ],
                        'qtd',
    ];
    ?>
        <div class="row">
            <div class="col-lg-12">
               <?php echo Html::panel([
                    'body' => '<div class="panel-body">'.Gridview::widget([
                            'dataProvider' => $providerVendaProduto,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-venda-produto']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Venda Produto'),
                            ],
                                                'columns' => $gridColumnVendaProduto
                        ]).'</div>'
                ]);
            ?>
            </div>
        </div>
        <?php
}
?>
    </div>
</div>
