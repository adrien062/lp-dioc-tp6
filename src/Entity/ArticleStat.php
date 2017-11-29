<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ArticleStat
{
    const CREATE = 'create';
    const UPDATE = 'update';
    const VIEW = 'view';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $action;

    /**
     * @ORM\ManyToOne(targetEntity="Article")
     */
    private $article;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string")
     */
    private $ip;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * ArticleStat constructor.
     * @param $action
     * @param $article
     * @param $date
     * @param $ip
     * @param $user
     */
    public function __construct($action, Article $article, $date, $ip, $user)
    {
        $this->action = $action;
        $this->article = $article;
        $this->date = $date;
        $this->ip = $ip;
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }



    // Uniquement des getter et un constructeur
}
