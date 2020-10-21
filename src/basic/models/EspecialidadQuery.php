<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Especialidad]].
 *
 * @see Especialidad
 */
class EspecialidadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Especialidad[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Especialidad|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
