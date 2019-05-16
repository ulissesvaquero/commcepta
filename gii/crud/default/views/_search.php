<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator mootensai\enhancedgii\crud\Generator */

$fk = $generator->generateFK();

echo "<?php\n";
?>

use kartik\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

    <?= "<?php " ?>$form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<?php
$count = 0;
    echo "<div class='row'>\n";
foreach ($generator->getColumnNames() as $attribute) {
    if (!in_array($attribute, $generator->skippedColumns)) {
        if (++$count < 6) {
            echo $count > 1 ? "<div class='col-xs-12 col-sm-6 col-md-3 col-lg-3'>\n" : '';
            echo "    <?= " . $generator->generateActiveField($attribute, $fk) . " ?>\n\n";
            echo $count > 1 ? "</div>\n" : '';
        } else {
            echo "    <?php /* echo " . $generator->generateActiveField($attribute, $fk) . " */ ?>\n\n";
        }
    }
}
    echo "</div>\n";
?>
    <div class="form-group">
        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Pesquisar') ?>, ['class' => 'btn btn-primary']) ?>
        <?= "<?= " ?>Html::a(<?= $generator->generateString('Limpar Pesquisa') ?>, ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
