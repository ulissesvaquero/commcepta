<div class="form-group" id="add-venda-produto">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'VendaProduto',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        'produto_id' => [
            'label' => 'Produto',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Produto::find()->where('is_ativo <> 0')->orderBy('id')->asArray()->all(), 'id', 'nome'),
                'options' => ['placeholder' => 'Produto'],
            ],
            'columnOptions' => ['width' => '300px']
        ],
        'qtd' => [
                'type' => TabularForm::INPUT_TEXT , 
                'columnOptions' => ['width' => '80px']
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowVendaProduto(' . $key . '); return false;', 'id' => 'venda-produto-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Adicionar Produto', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowVendaProduto()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

