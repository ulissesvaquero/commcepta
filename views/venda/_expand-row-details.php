<?php 
    use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
    
    
    //Crio um arrayDataProvider
    
    $dataProvider = new ActiveDataProvider([
        'query' => $model->getVendaProdutos(),
        'pagination' => [
            'pageSize' => false, // Sem paginação
        ],
        'sort' => false //Sem ordenação
    ]);
    
    $gridColumn = [
        'produto.nome',
        [
            'attribute' => 'produto.valor', //um outro jeito de se configurar a grid
        ],
        'qtd'
    ];
    
    echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'layout' => '{items}', // Mostra apenas os itens
    ]); 
?>