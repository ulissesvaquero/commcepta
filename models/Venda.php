<?php

namespace app\models;

use Yii;
use \app\models\base\Venda as BaseVenda;

/**
 * This is the model class for table "venda".
 */
class Venda extends BaseVenda
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['vendedor_id'], 'required'],
            [['vendedor_id'], 'integer'],
            [['valor_total'], 'number'],
            [['dt_criacao'], 'safe']
        ]);
    }
	
}
