<?php

use kartik\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VendaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-venda-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<div class='row'>

    <div class='col-xs-12 col-sm-6 col-md-3 col-lg-3'>
        <?= $form->field($model, 'vendedor_id')->widget(\kartik\widgets\Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\app\models\Vendedor::find()->orderBy('id')->asArray()->all(), 'id', 'nome'),
            'options' => ['placeholder' => 'Vendedor'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    
    </div>
    <div class='col-xs-12 col-sm-6 col-md-3 col-lg-3'>
        <?php //$form->field($model, 'dt_criacao')->textInput(['placeholder' => 'Dt Criacao']) ?>
    
    </div>
</div>
    <div class="form-group">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Limpar Pesquisa', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
