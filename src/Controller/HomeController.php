<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(UserRepository $userRepo, UserInterface $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $pointDb = $_POST['points'];

        $points = $user->getPoint();

        if ($pointDb !== null) {
            $points = intVal($pointDb);
            if ($points !== 0) {
                $user->setPoint($points);
                $entityManager->persist($user);
            }
        }
        $entityManager->flush();

        return $this->render('home/index.html.twig', [
            'users' => $userRepo->findAll(),
        ]);
    }
}
