<?php

use kartik\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Venda */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'VendaProduto', 
        'relID' => 'venda-produto', 
        'value' => \yii\helpers\Json::encode($model->vendaProdutos),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="venda-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">

        <div class='col-xd-12 col-sm-6 col-md-4'>
            <?= $form->field($model, 'vendedor_id')->widget(\kartik\widgets\Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\app\models\Vendedor::find()->where('is_ativo <> 0')->orderBy('id')->asArray()->all(), 'id', 'nome'),
            'options' => ['placeholder' => 'Vendedor'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
        </div>
    
        <div class='row'>
            <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                <?php
                $forms = [
                [
                        'label' =>  'Produtos',
                        'content' => $this->render('_formVendaProduto', [
                            'row' => \yii\helpers\ArrayHelper::toArray($model->vendaProdutos),
                    ]),
                ],
                ];
                echo kartik\tabs\TabsX::widget([
                    'items' => $forms,
                    'position' => kartik\tabs\TabsX::POS_ABOVE,
                    'encodeLabels' => false,
                    'pluginOptions' => [
                        'bordered' => true,
                        'sideways' => true,
                        'enableCache' => false,
                    ],
                ]);
                ?>
            </div>
        </div>

    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
