<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class ArticleStatsLogger
{
    private $requestStack;
    private $tokenStorage;
    private $manager;

    public function __construct(RequestStack $requestStack, TokenStorage $tokenStorage, EntityManager $manager)
    {
        $this->requestStack = $requestStack;
        $this->tokenStorage = $tokenStorage;
        $this->manager = $manager;
    }

    public function log(Article $article, string $action): void
    {
        $user = $this->tokenStorage->getToken()->getUser();

        $request = $this->requestStack->getCurrentRequest();
        $articleStats = new ArticleStat($action, $article, new \DateTime("now"), $request->getClientIp(), $user);

        $this->manager->persist($articleStats);
        // Créer un article stat et le persist.
    }
}
