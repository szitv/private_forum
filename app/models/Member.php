<?php

class Member extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $uId;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    public $userName;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    public $passWord;

    /**
     *
     * @var integer
     * @Column(type="integer", length=6, nullable=false)
     */
    public $token;


    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setConnectionService('EvmacDB');
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tb_account';
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
