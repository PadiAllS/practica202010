<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Patologia]].
 *
 * @see Patologia
 */
class PatologiaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Patologia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Patologia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
