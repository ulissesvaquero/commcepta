<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "venda_produto".
 *
 * @property integer $venda_id
 * @property integer $produto_id
 * @property integer $qtd
 *
 * @property \app\models\Produto $produto
 * @property \app\models\Venda $venda
 */
class VendaProduto extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'produto',
            'venda'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['venda_id', 'produto_id'], 'required'],
            [['venda_id', 'produto_id', 'qtd'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'venda_produto';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'venda_id' => 'Venda ID',
            'produto_id' => 'Produto ID',
            'qtd' => 'Qtd',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(\app\models\Produto::className(), ['id' => 'produto_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVenda()
    {
        return $this->hasOne(\app\models\Venda::className(), ['id' => 'venda_id']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\VendaProdutoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\VendaProdutoQuery(get_called_class());
    }
}
