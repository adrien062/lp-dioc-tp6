<?php

namespace App\Controller;

use App\Article\CountViewUpdater;
use App\Article\NewArticleHandler;
use App\Article\UpdateArticleHandler;
use App\Article\ViewArticleHandler;
use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route(path="/show/{slug}", name="article_show")
     */
    public function showAction()
    {
        return $this->render('Article/new.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route(path="/new", name="article_new")
     */
    public function newAction(Request $request, EntityManager $manager)
    {
        $user= $this->get('security.context')->getToken()->getUser();

        $form = $this->createForm(ArticleType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            $newArticle = $this->get(\App\Article\NewArticleHandler::class);
            $newArticle->handle($article);

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('article_show', array('slug' => $article->getSlug()));
        }

        return $this->render('Article/new.html.twig', ['form' => $form->createView()]);
        // Seul les auteurs doivent avoir access.
    }

    /**
     * @Route(path="/update/{slug}", name="article_update")
     */
    public function updateAction()
    {
        // Seul les auteurs doivent avoir access.
        // Seul l'auteur de l'article peut le modifier
    }
}
