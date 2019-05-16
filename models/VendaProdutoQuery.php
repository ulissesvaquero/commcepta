<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VendaProduto]].
 *
 * @see VendaProduto
 */
class VendaProdutoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return VendaProduto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VendaProduto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
