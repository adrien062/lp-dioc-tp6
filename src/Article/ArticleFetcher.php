<?php

namespace App\Article;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ArticleFetcher
{
    private $fetchLimit;
    private $registry;

    public function __construct($fetchLimit, Registry $registry)
    {
        $this->fetchLimit = intval($fetchLimit);
        $this->registry = $registry;
    }

    public function fetch() : array
    {
        return $this->registry->getRepository(Article::class)->findBy(array(), array("createdAt" => "DESC"), $this->fetchLimit);

        // Retourne les 10 derniers articles.
        // La limit (ici 10) doit provenir d'une variable d'env.
    }
}
