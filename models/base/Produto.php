<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "produto".
 *
 * @property integer $id
 * @property string $nome
 * @property string $descricao
 * @property double $valor
 * @property integer $is_ativo
 *
 * @property \app\models\VendaProduto[] $vendaProdutos
 */
class Produto extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'vendaProdutos'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'valor'], 'required'],
            [['descricao'], 'string'],
            [['valor'], 'number'],
            [['nome'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'valor' => 'Valor',
            'is_ativo' => 'Is Ativo',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendaProdutos()
    {
        return $this->hasMany(\app\models\VendaProduto::className(), ['produto_id' => 'id']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\ProdutoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProdutoQuery(get_called_class());
    }
}
