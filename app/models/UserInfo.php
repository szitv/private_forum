<?php

class UserInfo extends \Phalcon\Mvc\Model
{
    public $uId;
    public $nickName;
    public $portrait;

    public function initialize()
    {
        $this->setConnectionService('EvmacDB');
    }

    public function getSource()
    {
        return 'tb_userinfo';
    }

    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


}
