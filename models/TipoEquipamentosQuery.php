<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TipoEquipamentos]].
 *
 * @see TipoEquipamentos
 */
class TipoEquipamentosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TipoEquipamentos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TipoEquipamentos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}