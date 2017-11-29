<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;

class ViewArticleHandler
{
    private $countViewUpdater;
    private $articleStatsLogger;
    private $manager;
    public function __construct(CountViewUpdater $countViewUpdater, ArticleStatsLogger $articleStatsLogger, EntityManager $manager)
    {
        $this->countViewUpdater = $countViewUpdater;
        $this->articleStatsLogger = $articleStatsLogger;
        $this->manager = $manager;
    }

    public function handle(Article $article)
    {
        $this->countViewUpdater->update($article);


        $this->articleStatsLogger->log($article, ArticleStat::VIEW);

        $this->manager->persist($article);
        $this->manager->flush();
        // Appel le service de mise à jour de vue d'un article.
        // Log également un article stat avec pour action view.
    }
}
