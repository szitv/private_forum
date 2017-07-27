<?php

class Profile extends \Phalcon\Mvc\Model
{

    public $uId;
    public $nickName;
    public $portrait;
    public $rlevel;
    public $ruId;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setConnectionService('EvmacDB');
    }

    public function getSource()
    {
        return 'tb_userinfo';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Member[]|Member
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Member
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


}
