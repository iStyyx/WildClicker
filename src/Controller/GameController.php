<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     */
    public function home(UserRepository $userRepo, UserInterface $user, EntityManagerInterface $entityManager): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $points = $user->getPoint();
    
        if (isset($_POST['points']) && $_POST['points'] !== null) {
            $pointDb = $_POST['points'];
            $points = intVal($pointDb);
            if ($points !== 0) {
                $user->setPoint($points);
                $entityManager->persist($user);
            }
        } else {
            $_POST['points'] = 0;
        }
        $entityManager->flush();

        return $this->render('game/index.html.twig', [
            'users' => $userRepo->findAll(),
            'top3' => $userRepo->findBy([], ['point' => 'DESC'], 3),
            'top25' => $userRepo->findBy([], ['point' => 'DESC'], 25),
        ]);
    }
}
