<?php

namespace App\Article;

use App\Entity\Article;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class CountViewUpdater
{
    private $tokenStorage;
    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function update(Article $article): void
    {
        $user = $this->tokenStorage->getToken()->getUser();

        if($article->getAuthor() !== $user){
            $article->setCountView($article->getCountView() + 1);
        }
        // Incremente le compteur de vue, sauf si l'utilisareur courant est également l'auteur de l'article.
    }
}
