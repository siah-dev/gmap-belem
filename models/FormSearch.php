<?php
/**
 * Created by PhpStorm.
 * User: Suporte
 * Date: 23/08/2015
 * Time: 10:56
 */

namespace app\models;

use Yii;
use yii\base\model;

class FormSearch extends Model {
    public $conteudo;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['conteudo'], 'required'],
        ];
    }
}
