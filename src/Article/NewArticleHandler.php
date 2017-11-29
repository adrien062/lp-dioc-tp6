<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class NewArticleHandler
{
    public function handle(Article $article): void
    {
        $slugGene = new SlugGenerator();
        $slug = $slugGene->generate($article->getTitle());

        $article->setSlug($slug);

       // $user= TokenStorage::class->get('security.context')->getToken()->getUser();
        //$article->setAuthor($user);


        // Slugify le titre et ajoute l'utilisateur courant comme auteur de l'article
        // Log également un article stat avec pour action create.
    }
}
