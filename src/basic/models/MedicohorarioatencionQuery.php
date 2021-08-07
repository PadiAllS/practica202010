<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Medicohorarioatencion]].
 *
 * @see Medicohorarioatencion
 */
class MedicohorarioatencionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Medicohorarioatencion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Medicohorarioatencion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
