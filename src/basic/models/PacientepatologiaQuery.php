<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Pacientepatologia]].
 *
 * @see Pacientepatologia
 */
class PacientepatologiaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Pacientepatologia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Pacientepatologia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
