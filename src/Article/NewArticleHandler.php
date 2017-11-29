<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class NewArticleHandler
{
    private $tokenStorage;
    private $articleStatsLogger;

    public function __construct(ArticleStatsLogger $articleStatsLogger, TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
        $this->articleStatsLogger = $articleStatsLogger;
    }

    public function handle(Article $article): void
    {
        $user = $this->tokenStorage->getToken()->getUser();

        $slugGene = new SlugGenerator();
        $slug = $slugGene->generate($article->getTitle());

        $article->setSlug($slug);
        $article->setAuthor($user);

        $this->articleStatsLogger->log($article, ArticleStat::CREATE);
        // Slugify le titre et ajoute l'utilisateur courant comme auteur de l'article
        // Log également un article stat avec pour action create.
    }
}
