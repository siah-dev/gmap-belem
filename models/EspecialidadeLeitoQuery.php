<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[EspecialidadeLeito]].
 *
 * @see EspecialidadeLeito
 */
class EspecialidadeLeitoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return EspecialidadeLeito[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EspecialidadeLeito|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}