<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Obrasocial]].
 *
 * @see Obrasocial
 */
class ObrasocialQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Obrasocial[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Obrasocial|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
