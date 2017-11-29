<?php

namespace App\Controller;

use App\Entity\ArticleStat;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/stats")
 */
class ArticleStatController extends Controller
{
    /**
     * @Route(path="/", name="stats")
     */
    public function showAction()
    {
        $user = $this->getUser();
        if(!$user->isAuthor()){
            throw $this->createAccessDeniedException('Il faut etre un auteur');
        }

        $articleStat = $this->getDoctrine()->getManager()->getRepository(ArticleStat::class)->findAll();

        return $this->render('ArticleStat/index.html.twig', array('articleStat' => $articleStat));
        // Seul les auteurs doivent avoir access.
    }
}
