<?php

namespace app\models;

use Yii;
use \app\models\base\Produto as BaseProduto;

/**
 * This is the model class for table "produto".
 */
class Produto extends BaseProduto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['nome', 'valor'], 'required'],
            [['descricao'], 'string'],
            [['valor'], 'number'],
            [['nome'], 'string', 'max' => 100],
        ]);
    }
	
}
