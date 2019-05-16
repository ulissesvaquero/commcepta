<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "venda".
 *
 * @property integer $id
 * @property integer $vendedor_id
 * @property double $valor_total
 * @property string $dt_criacao
 * @property integer $is_ativo
 *
 * @property \app\models\Vendedor $vendedor
 * @property \app\models\VendaProduto[] $vendaProdutos
 */
class Venda extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'vendedor',
            'vendaProdutos'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vendedor_id'], 'required'],
            [['vendedor_id'], 'integer'],
            [['valor_total'], 'number'],
            [['dt_criacao'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'venda';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vendedor_id' => 'Vendedor',
            'valor_total' => 'Valor Total',
            'dt_criacao' => 'Data',
            'is_ativo' => 'Is Ativo',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendedor()
    {
        return $this->hasOne(\app\models\Vendedor::className(), ['id' => 'vendedor_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendaProdutos()
    {
        return $this->hasMany(\app\models\VendaProduto::className(), ['venda_id' => 'id']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\VendaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\VendaQuery(get_called_class());
    }
}
