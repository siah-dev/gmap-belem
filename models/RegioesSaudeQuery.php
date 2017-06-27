<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RegioesSaude]].
 *
 * @see RegioesSaude
 */
class RegioesSaudeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return RegioesSaude[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RegioesSaude|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}