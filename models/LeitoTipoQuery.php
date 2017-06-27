<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LeitoTipo]].
 *
 * @see LeitoTipo
 */
class LeitoTipoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return LeitoTipo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LeitoTipo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}