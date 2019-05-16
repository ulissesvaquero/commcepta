<?php

namespace app\models;

use Yii;
use \app\models\base\VendaProduto as BaseVendaProduto;

/**
 * This is the model class for table "venda_produto".
 */
class VendaProduto extends BaseVendaProduto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['venda_id', 'produto_id'], 'required'],
            [['venda_id', 'produto_id', 'qtd'], 'integer']
        ]);
    }
	
}
