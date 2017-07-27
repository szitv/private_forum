<?php

class Article extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $article_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $module_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    public $type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    public $type_status;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $like_times;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $uid;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $article_init;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $article_real;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $create_at;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $update_at;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    public $status;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("phalcon");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'article';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Article[]|Article
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Article
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
