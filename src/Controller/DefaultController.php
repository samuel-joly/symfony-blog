<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
	$articles = $this->getDoctrine()
			 ->getRepository(Article::class)
			 ->findAll();
	if(!$articles) {
		throw $this->createNotFoundException(
		'Aucun article disponible');
	}
        return $this->render('default/index.html.twig', [
            'articles' =>$articles]);
    }
}
