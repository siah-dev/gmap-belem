<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[EspecEquipamento]].
 *
 * @see EspecEquipamento
 */
class EspecEquipamentoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return EspecEquipamento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EspecEquipamento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}