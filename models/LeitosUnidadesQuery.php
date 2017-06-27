<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LeitosUnidades]].
 *
 * @see LeitosUnidades
 */
class LeitosUnidadesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return LeitosUnidades[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LeitosUnidades|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}