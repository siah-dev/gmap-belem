<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[EquipamentosUnidades]].
 *
 * @see EquipamentosUnidades
 */
class EquipamentosUnidadesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return EquipamentosUnidades[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EquipamentosUnidades|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}