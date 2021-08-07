<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Horarioatencion]].
 *
 * @see Horarioatencion
 */
class HorarioatencionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Horarioatencion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Horarioatencion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
