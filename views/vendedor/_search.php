<?php

use kartik\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VendedorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-vendedor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<div class='row'>
    <div class='col-xs-12 col-sm-6 col-md-3 col-lg-3'>
        <?= $form->field($model, 'nome')->textInput(['maxlength' => true, 'placeholder' => 'Nome']) ?>
    
    </div>
</div>
    <div class="form-group">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Limpar Pesquisa', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
