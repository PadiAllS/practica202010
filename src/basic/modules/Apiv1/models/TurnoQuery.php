<?php

namespace app\modules\Apiv1\models;

/**
 * This is the ActiveQuery class for [[Turno]].
 *
 * @see Turno
 */
class TurnoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Turno[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Turno|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
