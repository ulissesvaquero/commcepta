<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\VendaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Venda';
$this->params['breadcrumbs'][] = $this->title;
//$search = "$('.search-button').click(function(){
//	$('.search-form').toggle(1000);
//	return false;
//});";
//$this->registerJs($search);
?>
<div class="venda-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Adicionar Venda', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="search-form">
        <?= Html::panel(['body' => '<div class="panel-body">'.$this->render('_search', ['model' => $searchModel]).'</div>']); ?>
    </div>
    <?php 
    $gridColumn = [
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            // uncomment below and comment detail if you need to render via ajax
            // 'detailUrl'=>Url::to(['/site/book-details']),
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand-row-details', ['model' => $model]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true
        ],
        [
                'attribute' => 'vendedor_id',
                'label' => 'Vendedor',
                'value' => function($model){                   
                    return $model->vendedor->nome;                   
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Vendedor::find()->asArray()->all(), 'id', 'nome'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Vendedor', 'id' => 'grid-venda-search-vendedor_id'],
                'pageSummary' => 'Total'
            ],
        [
            'attribute' => 'valor_total',
            'format' => 'currency',
            'pageSummary'=>true
        ],
        'dt_criacao:datetime',
        [
            'class' => 'kartik\grid\ActionColumn',
            'width' => '7%',
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'showPageSummary' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-venda']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
        ],
    ]); ?>

</div>
