<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "vendedor".
 *
 * @property integer $id
 * @property string $nome
 * @property string $telefone
 * @property string $endereco
 * @property integer $is_ativo
 *
 * @property \app\models\Venda[] $vendas
 */
class Vendedor extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'vendas'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 100],
            [['telefone'], 'string', 'max' => 20],
            [['endereco'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendedor';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'telefone' => 'Telefone',
            'endereco' => 'Endereço',
            'is_ativo' => 'Is Ativo',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendas()
    {
        return $this->hasMany(\app\models\Venda::className(), ['vendedor_id' => 'id']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\VendedorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\VendedorQuery(get_called_class());
    }
}
