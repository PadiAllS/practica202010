<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Medico]].
 *
 * @see Medico
 */
class MedicoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Medico[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Medico|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
