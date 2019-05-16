<?php

use kartik\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model app\models\Produto */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="produto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">

        <div class='col-xd-12 col-sm-6 col-md-4'>
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true, 'placeholder' => 'Nome']) ?>
        </div>
    
        <div class='col-xd-12 col-sm-6 col-md-4'>
            <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>
        </div>
    
        <div class='col-xd-12 col-sm-6 col-md-4'>
           <?= $form->field($model, 'valor')->widget(MaskMoney::className())?>
        </div>
    
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
