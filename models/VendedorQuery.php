<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Vendedor]].
 *
 * @see Vendedor
 */
class VendedorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Vendedor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Vendedor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
