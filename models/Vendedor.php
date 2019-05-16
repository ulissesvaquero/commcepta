<?php

namespace app\models;

use Yii;
use \app\models\base\Vendedor as BaseVendedor;

/**
 * This is the model class for table "vendedor".
 */
class Vendedor extends BaseVendedor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 100],
            [['telefone'], 'string', 'max' => 20],
            [['endereco'], 'string', 'max' => 255],
            [['is_ativo'], 'string', 'max' => 4]
        ]);
    }
	
}
