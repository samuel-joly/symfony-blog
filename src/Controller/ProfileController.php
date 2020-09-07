<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
/*
* @Route("/profile")
*/
class ProfileController extends AbstractController
{
    /**
     * @Route("profile/{id}", name="account", methods={"GET"})
     */
    public function index(User $user) 
    {
        return $this->render('profile/index.html.twig', [
            'user' =>$user,
        ]);
    }
}
