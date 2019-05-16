<?php

use kartik\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Vendedor */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Venda', 
        'relID' => 'venda', 
        'value' => \yii\helpers\Json::encode($model->vendas),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="vendedor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">

        <div class='col-xd-12 col-sm-6 col-md-4'>
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true, 'placeholder' => 'Nome']) ?>
        </div>
    
        <div class='col-xd-12 col-sm-6 col-md-4'>
            <?= $form->field($model, 'telefone')->widget(\yii\widgets\MaskedInput::className(), [
                  'mask' => '(99)999999999',
            ]) ?>
        </div>
    
        <div class='col-xd-12 col-sm-6 col-md-4'>
            <?= $form->field($model, 'endereco')->textarea(['rows' => 5]) ?>
        </div>

    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
