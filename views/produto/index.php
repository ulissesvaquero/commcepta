<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Produto';
$this->params['breadcrumbs'][] = $this->title;
//$search = "$('.search-button').click(function(){
//	$('.search-form').toggle(1000);
//	return false;
//});";
//$this->registerJs($search);
?>
<div class="produto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Adicionar Produto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="search-form">
        <?= Html::panel(['body' => '<div class="panel-body">'.$this->render('_search', ['model' => $searchModel]).'</div>']); ?>
    </div>
    <?php 
    $gridColumn = [
        'nome',
        'descricao:ntext',
        'valor:currency',
        'is_ativo',
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-produto']],
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
