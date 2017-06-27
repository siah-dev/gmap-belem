<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ServicosClassificacaoUnid]].
 *
 * @see ServicosClassificacaoUnid
 */
class ServicosClassificacaoUnidQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ServicosClassificacaoUnid[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ServicosClassificacaoUnid|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}