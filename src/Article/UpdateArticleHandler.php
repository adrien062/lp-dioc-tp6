<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;
use Symfony\Component\Validator\Constraints\DateTime;

class UpdateArticleHandler
{
    private $articleStatsLogger;

    /**
     * UpdateArticleHandler constructor.
     * @param $articleStatsLogger
     */
    public function __construct(ArticleStatsLogger $articleStatsLogger)
    {
        $this->articleStatsLogger = $articleStatsLogger;
    }

    public function handle(Article $article): void
    {

        $slugGene = new SlugGenerator();
        $slug = $slugGene->generate($article->getTitle());

        $article->setSlug($slug);
        $article->setUpdatedAt(new \DateTime("now"));

        $this->articleStatsLogger->log($article, ArticleStat::UPDATE);

        // Slugify le titre et met à jour la date de mise à jour de l'article
        // Log également un article stat avec pour action update.
    }
}
