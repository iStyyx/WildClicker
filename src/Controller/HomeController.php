<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(UserRepository $userRepo): Response
    {


        return $this->render('home/index.html.twig', [
            'users' => $userRepo->findAll(),
        ]);
    }
}
